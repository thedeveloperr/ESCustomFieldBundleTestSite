<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Sbcamp\Bundle\CustomFieldsBundle\Entity\ESMappingField;
use Sbcamp\Bundle\CustomFieldsBundle\ESDocument\ProfileInfoDocument;
use Sbcamp\Bundle\CustomFieldsBundle\ESRepository\ProfileInfoDocumentRepository;
use Sbcamp\Bundle\CustomFieldsBundle\Repository\CustomFieldsRecordsMapsRepository;
use Sbcamp\Bundle\CustomFieldsBundle\Entity\CustomFieldsRecordsMaps;
use Sbcamp\Bundle\CustomFieldsBundle\Repository\ESMappingFieldRepository;

/**
 * Class CustomProfileFieldsManagerService This service is intended for user of bundle. User must interact through this
 * See all the methods
 * @package Sbcamp\Bundle\CustomFieldsBundle
 */
class CustomProfileFieldsManagerService implements CustomProfileFieldsManagerServiceInterface {

  private $datatypeLimits = [];

  /**
   * @var CustomFieldsRecordsMapsRepository
   */
  private $customFieldRepo;

  /**
   * @var ESMappingFieldRepository
   */
  private $esMappingFieldRepo;

  /**
   * @var ProfileInfoDocumentRepository
   */
  private $profileInfoDocRepo;

  /**
   * @var ESIndexManagerInterface
   */
  private $esIndexManager;

  public function __construct(CustomFieldsRecordsMapsRepository $CustomFieldRepo,
                              ESMappingFieldRepository $ESMappingFieldRepo,
                              ProfileInfoDocumentRepository $profileInfoDocRepo,
                              ESIndexManager $indexManager, array $configs) {

    $this->customFieldRepo = $CustomFieldRepo;
    $this->esMappingFieldRepo = $ESMappingFieldRepo;
    $this->profileInfoDocRepo = $profileInfoDocRepo;
    $this->esIndexManager = $indexManager;

    /**
     * TODO: Hardcoded For Testing only remove it and replace it with reading configs
     *
     */
    $this->datatypeLimits['keyword'] = 5;
    $this->datatypeLimits['boolean'] = 3;
    $this->datatypeLimits['date'] = 2;
  }

  /**
   * @param string $datatype
   * @param int    $limit
   */
  public function setDatatypeLimit(string $datatype, int $limit) {

    $this->datatypeLimits[$datatype] = $limit;
  }

  /**
   * @param string $datatype
   *
   * @return int
   */
  public function getDatatypeLimit(string $datatype): int {

    return $this->datatypeLimits[$datatype];
  }

  /**
   *
   * Get all the custom fields created by a user
   *
   * @param string $ownerId
   *
   * @return CustomField[]
   */
  public function getCustomFields(string $ownerId): array {
    $customFieldsRecords = $this->customFieldRepo->fetchCustomFieldsRecordOfOwner($ownerId);
    return array_map(function($item) {
      /**
       * @var CustomFieldsRecordsMaps $item
       */
      return new CustomField($item->getOwnerId(), $item->getFieldName(), $item->getMachineFieldName(), $item->getDatatype());
    }, $customFieldsRecords);
  }

  /**
   * Get the custom field created by a user using userId and Fields internal machine name
   *
   * @param string $ownerId
   * @param string $machineName
   *
   * @return CustomFieldInterface
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getCustomField(string $ownerId, string $machineName): CustomFieldInterface {
    $customFieldsRecord = $this->customFieldRepo->fetchByCompositeId($ownerId, $machineName);
    return new CustomField($customFieldsRecord->getOwnerId(), $customFieldsRecord->getFieldName(),
      $customFieldsRecord->getMachineFieldName(), $customFieldsRecord->getDatatype());
  }

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return ESMappingFieldInterface
   * @throws \Exception
   */
  private function getESFieldNotInUse(string $ownerId, string $datatype): ESMappingFieldInterface {

    $inUse = $this->customFieldRepo->fetchESFieldNamesInUse($ownerId, $datatype);
    $available = $this->esMappingFieldRepo->fetchESMappingFieldsByDataype($datatype);
    var_dump($available);

    $elementsNotinUse = array_filter($available, function($item) use ($inUse) {
      /**
       * @var ESMappingField $item
       */

      return !in_array($item->getFieldName(), $inUse);
    });

    // To start the array from 0 index.
    // PHP Rant: because for whatever reason php decided to use associative array as normal array too :/
    $elementsNotinUse = array_values($elementsNotinUse);
    if (count($elementsNotinUse) === 0) {
      throw new \Exception("No Elastic Field Name available");
    }
    return $elementsNotinUse[0];
  }

  /**
   * For Adding a custom field for a user.
   * User must send the CustomFieldInterface's implementation object to add it
   *
   * @param CustomFieldInterface $field
   *
   * @throws \Exception
   */
  public function addCustomField(CustomFieldInterface $field) {
    if ($this->doesCustomFieldExists($field->getOwnerId(),$field->getMachineName())) {
      throw new \Exception("Field Already Exists");
    }
    if ($this->dataTypeLimitReached($field->getOwnerId(), $field->getType())) {
      throw new \Exception("Data Limit Reached");
    }

    $esFieldNotInUse = $this->getESFieldNotInUse($field->getOwnerId(), $field->getType());
    $newCustomFieldRecord = new CustomFieldsRecordsMaps($field);
    $newCustomFieldRecord->setEsFieldName($esFieldNotInUse->getFieldName());
    $this->customFieldRepo->insert($newCustomFieldRecord);
    $this->esIndexManager->addNewMappingField($esFieldNotInUse);
  }

  /**
   *
   * Update the name of existing Field
   *
   * @param CustomFieldInterface $oldfield
   * @param CustomFieldInterface $newField
   *
   * @throws \Exception
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function updateCustomFieldName(CustomFieldInterface $oldfield, CustomFieldInterface $newField) {

    if (!$this->doesCustomFieldExists($oldfield->getOwnerId(),$oldfield->getMachineName())) {
      throw new \Exception("Field doesn't Exists");
    }

    if ($oldfield->getOwnerId() !== $newField->getOwnerId()) {
      throw new \Exception("Owner Id doesn't match for given old and new custom fields");
    }

    if ($oldfield->getType() !== $newField->getType()) {
      throw new \Exception("Datatype of existing field can't be changed. Delete it and create a new");
    }
    $updatedOldCustomFieldRecord = $this->customFieldRepo->fetchByCompositeId($oldfield->getOwnerId(), $oldfield->getMachineName());
    $updatedOldCustomFieldRecord->setFieldName($newField->getName());

    // Doctrine automatically replaces old value
    $this->customFieldRepo->insert($updatedOldCustomFieldRecord);
  }

  /**
   *
   * Checks for if custom fields already exists
   *
   * @param string $ownerId
   * @param string $machinename
   *
   * @return bool
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function doesCustomFieldExists(string $ownerId, string $machinename): bool {
    return $this->customFieldRepo->isMachineFieldNameInUse($ownerId, $machinename);
  }

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return bool
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function dataTypeLimitReached(string $ownerId, string $datatype): bool {
    return $this->customFieldRepo->countDatatypesUsed($ownerId, $datatype) === $this->datatypeLimits[$datatype];
  }

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return int
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function numDataTypeUsed(string $ownerId, string $datatype): int {
    return $this->customFieldRepo->countDatatypesUsed($ownerId, $datatype);
  }

  /**
   *
   * Used for insertions the profile info in elasticsearch
   *
   * @param ProfileInfoInterface $profile
   *
   * @return mixed
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function indexProfileInfo(ProfileInfoInterface $profile): string {

    $newDoc = new ProfileInfoDocument();

    foreach ($profile->getFields() as $field) {
      $esfName = $this->customFieldRepo->fetchESFieldName($profile->getOwnerId(), $field->getMachineName());

      $newDoc->addSetESField($esfName, $field->getValue());
    }
    return $this->profileInfoDocRepo->index($newDoc);
  }

  /**
   *
   * Used for updating the profile info in elasticsearch
   *
   * @param ProfileInfoInterface $profile
   *
   * @return string
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function reindexProfileInfo(ProfileInfoInterface $profile): string {

    $newDoc = new ProfileInfoDocument();
    if (is_null($profile->getESId())) {
      throw new \Exception("ESId missing. To reindex you must provide an es id");
    }
    $newDoc->setESId($profile->getESId());

    foreach ($profile->getFields() as $field) {
      $esfName = $this->customFieldRepo->fetchESFieldName($profile->getOwnerId(), $field->getMachineName());

      $newDoc->addSetESField($esfName, $field->getValue());
    }
    return $this->profileInfoDocRepo->reindex($newDoc);
  }

  /**
   * @param ProfileInfoInterface $profile
   *
   * @return mixed|void
   */
  public function deleteProfileInfo(ProfileInfoInterface $profile) {
    // TODO: Implement this
  }

  /**
   * @param string $ownerId
   * @param string $ESId
   *
   * @return ProfileInfoInterface
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getProfileInfo(string $ownerId, string $ESId): ProfileInfoInterface {
    $profileInfoDoc = $this->profileInfoDocRepo->findById($ESId);
    $result = new ProfileInfo($ownerId, $ESId);
    foreach ($profileInfoDoc->getESFields() as $key => $value) {
      $record = $this->customFieldRepo->fetchCustomFieldsRecordByEsFieldName($ownerId, $key);
      $field = new Field($record->getFieldName(), $record->getMachineFieldName(), $value, $record->getDatatype());
      $result->addField($field);
    }
    return $result;
  }

  /**
   * @param string $ownerId
   * @param string $ESId
   *
   * @return ProfileInfoInterface[]
   */
  public function getProfileInfos(string $ownerId): array {
    // TODO: Implement getProfileInfos() method.
  }
}
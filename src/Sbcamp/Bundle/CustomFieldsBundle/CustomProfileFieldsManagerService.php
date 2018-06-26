<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Elasticsearch\Client;
use Sbcamp\Bundle\CustomFieldsBundle\Repository\CustomFieldsRecordsMapsRepository;
use Sbcamp\Bundle\CustomFieldsBundle\Entity\CustomFieldsRecordsMaps;

class CustomProfileFieldsManagerService implements CustomProfileFieldsManagerServiceInterface {

  private $datatypeLimits = [];

  /**
   * @var Client
   */
  private $client;

  /**
   * @var CustomFieldsRecordsMapsRepository
   */
  private $customFieldRepo;

  public function _construct(Client $client, CustomFieldsRecordsMapsRepository $CustomFieldRepo, array $configs) {
    $this->client = $client;
    $this->customFieldRepo = $CustomFieldRepo;
  }

  public function setDatatypeLimit(string $datatype, int $limit) {

    $this->dataTypeLimits[$datatype] = $limit;
  }

  public function getDatatypeLimit(string $datatype): int {

    return $this->dataTypeLimits[$datatype];
  }

  public function getCustomFields(string $ownerId): array {

  }

  private function getESFieldNotInUse(string $ownerId, string $datatype): string {

  }

  /**
   * @param CustomFieldInterface $field
   *
   * @throws \Exception
   */
  public function addCustomField(CustomFieldInterface $field) {
    if ($this->doesCustomFieldExists($field)) {
      throw new \Exception("Field Already Exists");
    }
    if ($this->dataTypeLimitReached($field->getOwnerId(), $field->getType())) {
      throw new \Exception("Data Limit Reached");
    }
    $newCustomFieldRecord = new CustomFieldsRecordsMaps($field);
    $esFieldNotInUse = $this->getESFieldNotInUse($field->getOwnerId(), $field->getType());
    $newCustomFieldRecord->setEsFieldName($esFieldNotInUse);
    $this->customFieldRepo->insert($newCustomFieldRecord);

    // TODO: Add code to put new mapping field
    //$this->index->

  }

  /**
   * @param CustomFieldInterface $oldfield
   * @param CustomFieldInterface $newField
   *
   * @throws \Exception
   * @throws \Doctrine\ORM\NoResultException
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function updateCustomFieldName(CustomFieldInterface $oldfield, CustomFieldInterface $newField) {

    if (!$this->doesCustomFieldExists($oldfield)) {
      throw new \Exception("Field doesn't Exists");
    }

    if ($oldfield->getOwnerId() !== $newField->getOwnerId()) {
      throw new \Exception("Owner Id doesn't match for given old and new custom fields");
    }

    if ($oldfield->getType() !== $newField->getType()) {
      throw new \Exception("Datatype of existing field can't be changed. Delete it and create a new");
    }
    $updatedOldCustomFieldRecord = $this->customFieldRepo->fetchByCompositeId($oldfield->getOwnerId(),
      CustomFieldsRecordsMaps::createMachineFieldName($oldfield->getName()));
    $updatedOldCustomFieldRecord->setEsFieldName($newField->getName());
    $this->customFieldRepo->insert($updatedOldCustomFieldRecord);

    //    $newCustomFieldRecord = new CustomFieldsRecordsMaps($field);
    //    $newCustomFieldRecord->setEsFieldName($this->getESFieldNotInUse());
    //    $newCustomFieldRecord->save();
  }

  public function doesCustomFieldExists(CustomFieldInterface $field): bool {

  }

  public function dataTypeLimitReached(string $ownerId, string $datatype): bool {

  }

  public function numDataTypeUsed(string $ownerId, string $datatype): int {

  }

  public function addProfileInfo(ProfileInfoInterface $profile) {

  }

  public function updateProfileInfo(ProfileInfoInterface $profile) {

  }

  public function deleteProfileInfo(ProfileInfoInterface $profile) {

  }
}
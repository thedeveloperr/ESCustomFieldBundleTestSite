<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface CustomProfileFieldsManagerServiceInterface {

  public function setDatatypeLimit(string $datatype, int $limit);

  public function getDatatypeLimit(string $datatype): int;

  /**
   * @param string $ownerId
   *  TODO: Think if we need to give control to user to give custom Id to ES documents while indexing documents for the first time
   *
   * @return CustomFieldInterface[]
   */
  public function getCustomFields(string $ownerId): array;

  /**
   * @param CustomFieldInterface $field
   *
   * @return mixed
   */
  public function addCustomField(CustomFieldInterface $field);

  public function updateCustomFieldName(CustomFieldInterface $oldfield, CustomFieldInterface $newField);

  /**
   * @param CustomFieldInterface $field
   *
   * @return bool
   */
  public function doesCustomFieldExists(CustomFieldInterface $field): bool;

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return bool
   */
  public function dataTypeLimitReached(string $ownerId, string $datatype): bool;

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return int
   */
  public function numDataTypeUsed(string $ownerId, string $datatype): int;

  /**
   * @param ProfileInfoInterface $profile
   *
   * @return mixed
   */
  public function indexProfileInfo(ProfileInfoInterface $profile);

  /**
   * @param string $ownerId
   * @param string $ESId
   *
   * @return ProfileInfoInterface
   */
  public function getProfileInfo(string $ownerId, string $ESId): ProfileInfoInterface;

  /**
   * @param string $ownerId
   *
   * @return ProfileInfoInterface[]
   */
  public function getProfileInfos(string $ownerId): array;

  /**
   * @param ProfileInfoInterface $profile
   *
   * @return mixed
   */
  public function reindexProfileInfo(ProfileInfoInterface $profile);

  /**
   * @param ProfileInfoInterface $profile
   *
   * @return mixed
   */
  public function deleteProfileInfo(ProfileInfoInterface $profile);

  /*
   * TODO: Garbage collection too much :( do it later
   */
  //  deleteCustomField(CustomField $field);

}
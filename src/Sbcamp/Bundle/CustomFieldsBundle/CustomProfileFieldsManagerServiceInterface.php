<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface CustomProfileFieldsManagerServiceInterface {

  public function setDatatypeLimit(string $datatype, int $limit);

  public function getDatatypeLimit(string $datatype): int;

  /**
   * @param string $ownerId
   *
   * @return CustomFieldInterface[]
   */
  public function getCustomFields(string $ownerId): array;

  /**
   * @param string $ownerId
   * @param string $machineName
   *
   * @return CustomFieldInterface
   */
  public function getCustomField(string $ownerId, string $machineName): CustomFieldInterface;

  /**
   *
   * For Adding a custom field for a user.
   * User must send the CustomFieldInterface's implementation object to add it
   *
   * TODO: Think if we need to give control to user to give routing to ES documents while indexing documents for the first time
   *
   * @param CustomFieldInterface $field
   *
   * @return mixed
   */
  public function addCustomField(CustomFieldInterface $field);

  /**
   *
   * Update the name of existing Field
   *
   * @param CustomFieldInterface $oldfield
   * @param CustomFieldInterface $newField
   *
   * @return mixed
   */
  public function updateCustomFieldName(CustomFieldInterface $oldfield, CustomFieldInterface $newField);

  /**
   * Checks for if custom fields already exists
   *
   * @param string $ownerId
   * @param string $machinename
   *
   * @return bool
   */
  public function doesCustomFieldExists(string $ownerId, string $machinename): bool;

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
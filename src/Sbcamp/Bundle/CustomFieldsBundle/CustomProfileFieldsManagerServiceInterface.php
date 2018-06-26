<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface CustomProfileFieldsManagerServiceInterface {

  public function setDatatypeLimit(string $datatype, int $limit);

  public function getDatatypeLimit(string $datatype):int;

  public function addCustomField(CustomFieldInterface $field);

  public function updateCustomFieldName(CustomFieldInterface $oldfield, CustomFieldInterface $newField);

  public function doesCustomFieldExists(CustomFieldInterface $field): bool;

  public function dataTypeLimitReached(string $ownerId, string $datatype): bool ;

  public function numDataTypeUsed(string $ownerId, string $datatype): int ;

  public function addProfileInfo(ProfileInfoInterface $profile);

  public function updateProfileInfo(ProfileInfoInterface $profile);

  public function deleteProfileInfo(ProfileInfoInterface $profile);

  /**
   * @param string $ownerId
   *
   * @return CustomFieldInterface[]
   */
  public function getCustomFields(string $ownerId):array ;
  /*
   * TODO: Garbage collection too much :( do it later
   */
  //  deleteCustomField(CustomField $field);

}
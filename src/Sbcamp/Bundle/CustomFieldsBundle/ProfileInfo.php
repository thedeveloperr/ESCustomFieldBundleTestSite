<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

class ProfileInfo implements ProfileInfoInterface{

  /**
   * @var FieldInterface[] $fields
   */
  private $fields = [];

  /**
   * @var string $ESId
   */
  private $ESId = null;

  /**
   * @var string $ownerId
   */
  private $ownerId;

  public function __construct(string $ownerId, string $ESId=null) {
    $this->ESId = $ESId;
    $this->ownerId = $ownerId;
  }

  /**
   * @param string $id
   *
   * @return mixed
   */
  public function setOwnerId(string $id){
    $this->ownerId = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getOwnerId(): string{
    return $this->ownerId;
  }

  /**
   * @return string
   */
  public function getESId(): string{
    return $this->ESId;
  }

  /**
   * @param string $leadId
   *
   * @return mixed
   */
  public function setESId(string $id){
    $this->ESId = $id;
    return $this;
  }

  /**
   * @param FieldInterface $field
   *
   * @return mixed
   */
  public function addField(FieldInterface $field){
    $this->fields[] = $field;
  }

  /**
   * @param FieldInterface[]
   *
   */
  public function setFields(array $fieldsArr){

    $this->fields = $fieldsArr;
  }

  /**
   * @return FieldInterface[]
   */
  public function getFields(): array {
    return $this->fields;
  }

  /**
   * @param string $name
   *
   * @return mixed
   */
  public function removeFieldByName(string $name) {
    // TODO: Implement removeFieldByName() method.
  }

  //  /**
  //   * @param string $type
  //   *
  //   * @return mixed
  //   */
  //  public function removeFieldByType(string $type);

  /**
   * @param string $fieldName
   *
   * @return FieldInterface
   */
  public function getFieldByName(string $fieldName): FieldInterface{
    foreach ($this->getFields() as $field){
      if($field->getName()===$fieldName){
        return $field;
      }
    }
  }

  /**
   * @param string $machineFieldName
   *
   * @return FieldInterface
   */
  public function getFieldByMachineName(string $machineFieldName): FieldInterface{
    foreach ($this->getFields() as $field){
      if($field->getMachineName()===$machineFieldName){
        return $field;
      }
    }
  }

}
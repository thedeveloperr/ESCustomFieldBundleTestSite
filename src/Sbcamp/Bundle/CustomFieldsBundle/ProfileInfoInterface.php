<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface ProfileInfoInterface{

  /**
   * @param string $id
   *
   * @return mixed
   */
  public function setOwnerId(string $id);

  /**
   * @return string
   */
  public function getOwnerId(): string;

  /**
   * @return string
   */
  public function getESId(): string;

  /**
   * @param string $leadId
   *
   * @return mixed
   */
  public function setESId(string $id);

  /**
   * @param FieldInterface $field
   *
   * @return mixed
   */
  public function addField(FieldInterface $field);

  /**
   * @param FieldInterface[]
   *
   */
  public function setFields(array $fieldsArr);

  /**
   * @return FieldInterface[]
   */
  public function getFields(): array ;

  /**
   * @param string $name
   *
   * @return mixed
   */
  public function removeFieldByName(string $name);

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
  public function getFieldByName(string $fieldName): FieldInterface;

  /**
   * @param string $machineFieldName
   *
   * @return FieldInterface
   */
  public function getFieldByMachineName(string $machineFieldName): FieldInterface;

}
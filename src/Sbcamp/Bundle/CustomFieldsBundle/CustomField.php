<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

class CustomField implements CustomFieldInterface {

  /**
   * @var string
   */
  private $ownerId;

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $machineName;

  /**
   * @var string
   */
  private $type;

  public function __construct($ownerId, string $fieldName, string $machineFieldName, string $type) {
    $this->ownerId = $ownerId;
    $this->name = $fieldName;
    $this->machineName = $machineFieldName;
    $this->type = $type;
  }

  /**
   * @param string $machineFieldName
   *
   * @return $this|mixed
   */
  public function setMachineName(string $machineFieldName) {
    $this->machineName = $machineFieldName;
    return $this;
  }

  /**
   * @return string
   */
  public function getMachineName(): string {
    return $this->machineName;
  }

  /**
   * @param string $name
   *
   * @return $this
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * @param string $id
   *
   * @return $this
   */
  public function setOwnerId(string $id) {
    $this->ownerId = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getOwnerId(): string {
    return $this->ownerId;
  }

  /**
   * @param string $type
   *
   * @return $this
   */
  public function setType(string $type) {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return $this->type;
  }
}
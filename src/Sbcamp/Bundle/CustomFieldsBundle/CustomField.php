<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

class CustomField implements CustomFieldInterface {

  private $ownerId;

  private $name;

  private $machineName;

  private $type;

  public function __construct($ownerId, string $fieldName, string $machineFieldName, string $type) {
    $this->ownerId = $ownerId;
    $this->name = $fieldName;
    $this->machineName = $machineFieldName;
    $this->type = $type;
  }

  public function setMachineName(string $machineFieldName) {
    // TODO: Implement setMachineFieldName() method.
  }

  public function getMachineName(): string {
    // TODO: Implement getMachineFieldName() method.
  }

  public function setName(string $name) {
    // TODO: Implement setName() method.
  }

  public function getName(): string {
    // TODO: Implement getName() method.
  }

  public function setOwnerId(string $id) {
    // TODO: Implement setOwnerId() method.
  }

  public function getOwnerId(): string {
    // TODO: Implement getOwnerId() method.
  }

  public function setType(string $type) {
    // TODO: Implement setType() method.
  }

  public function getType(): string {
    // TODO: Implement getType() method.
  }
}
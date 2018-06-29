<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

class Field implements FieldInterface {

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $machineName;

  /**
   * @var mixed
   */
  private $value;

  /**
   * @var string
   */
  private $type;

  public function __construct(string $name, string $machineName, $value, string $type) {
    $this->name=$name;
    $this->machineName=$machineName;
    $this->value=$value;
    $this->type=$type;
  }

  /**
   * @param string $name
   *
   */
  public function setName(string $name){
    $this->name = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getMachineName(): string{
    return $this->machineName;
  }

  /**
   * @param string $name
   *
   */
  public function setMachineName(string $name){
    $this->machineName = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getName(): string{
    return $this->name;
  }

  /**
   * @param mixed $value
   *
   */
  public function setValue($value){
    $this->value = $value;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getValue(){
    return $this->value;
  }

  /**
   * @param string $type
   *
   */
  public function setType(string $type){
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getType(): string{
    return $this->type;
  }
}
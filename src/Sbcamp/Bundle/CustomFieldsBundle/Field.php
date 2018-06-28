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

  }

  /**
   * @return string
   */
  public function getMachineName(): string{

  }

  /**
   * @param string $name
   *
   */
  public function setMachineName(string $name){

  }

  /**
   * @return string
   */
  public function getName(): string{

  }

  /**
   * @param mixed $value
   *
   */
  public function setValue($value){

  }

  /**
   * @return mixed
   */
  public function getValue(){

  }

  /**
   * @param string $type
   *
   */
  public function setType(string $type){

  }

  /**
   * @return string
   */
  public function getType(): string{

  }
}
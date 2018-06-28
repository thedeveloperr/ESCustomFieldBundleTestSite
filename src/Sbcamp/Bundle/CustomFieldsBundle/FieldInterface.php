<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface FieldInterface {

  /**
   * @param string $name
   *
   */
  public function setName(string $name);

  /**
   * @return string
   */
  public function getMachineName(): string;

  /**
   * @param string $name
   *
   */
  public function setMachineName(string $name);

  /**
   * @return string
   */
  public function getName(): string;

  /**
   * @param mixed $value
   *
   */
  public function setValue($value);

  /**
   * @return mixed
   */
  public function getValue();

  /**
   * @param string $type
   *
   */
  public function setType(string $type);

  /**
   * @return string
   */
  public function getType(): string;

}



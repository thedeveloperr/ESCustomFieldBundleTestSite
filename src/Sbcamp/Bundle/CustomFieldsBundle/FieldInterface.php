<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface FieldInterface {

  //  /**
  //   * @param string $type
  //   *
  //   */
  //  public function setType(string $type);
  //
  //  /**
  //   * @return string
  //   */
  //  public function getType(): string;

  /**
   * @param string $type
   *
   */
  public function setName(string $name);

  /**
   * @return string
   */
  public function getMachineName(): string;

  /**
   * @param string $type
   *
   */
  public function setMachineName(string $name);

  /**
   * @return string
   */
  public function getName(): string;

  /**
   * @param string $type
   *
   */
  public function setValue(string $type);

  /**
   * @return string
   */
  public function getValue(): string;

}



<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface CustomFieldInterface {

  /**
   * @return string
   */
  public function getOwnerId():string ;

  /**
   * @param string $id
   *
   */
  public function setOwnerId(string $id);

  /**
   * @param string $type
   *
   */
  public function setType(string $type);

  /**
   * @return string
   */
  public function getType(): string ;

  /**
   * @param string $type
   *
   */
  public function setName(string $name);

  /**
   * @return string
   */
  public function getName(): string;

  /**
   * @return string
   */
  public function getMachineName(): string;

  /**
   * @return mixed
   */
  public function setMachineName(string $machineFieldName);


}
<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface ESIndexManagerInterface {

  /**
   * @param array $fields
   *
   * @return mixed
   */
  public function addNewMappingFields(array $fields);

  /**
   * @param array $settings
   *
   * @return mixed
   */
  public function addSettings(array $settings);

  /**
   * @return array
   */
  public function getMappings(): array ;

  /**
   * @param string $indexName
   *
   * @return mixed
   */
  public function setIndex(string $indexName);

  /**
   * @return string
   */
  public function getIndex():string ;

  /**
   * @param string $type
   *
   * @return mixed
   */
  public function setType(string $type);

  /**
   * @return string
   */
  public function getType():string;

}
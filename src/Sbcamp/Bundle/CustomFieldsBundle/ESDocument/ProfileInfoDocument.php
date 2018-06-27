<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESDocument;

class ProfileInfoDocument implements ESDocumentInterface {

  public static $index = 'profile_info_index';
  public static $type = '_doc';
  private $fields = [];

  public function __construct(){

  }

  /**
   * @return string
   */
  public static function getIndex(): string {
    return self::$index;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return self::$type;
  }

  /**
   * @param string $id
   *
   * @return $this
   */
  public function setId(string $id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getId(): string {
    return $this->id;
  }

  /**
   * @param array $arr
   *
   * @return mixed|void
   */
  public function setFields(array $arr) {
    $this->fields = $arr;
  }

  /**
   * @param string $key
   * @param string $value
   *
   * @return mixed|void
   */
  public function setFieldValue(string $key, string $value) {
    $this->fields[$key] = $value;
  }

  /**
   * @return array
   */
  public function getFields(): array {
    return $this->fields;
  }

  /**
   * @param string $key
   *
   * @return string
   */
  public function getFieldValue(string $key): string {
    return $this->fields[$key];
  }

}
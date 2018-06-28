<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESDocument;

class ProfileInfoDocument implements ESDocumentInterface {

  public static $index = 'profile_info_index';
  public static $type = '_doc';
  private $fields = [];


  private static $ownerIdKey = "ownerId";

  /**
   * @var string|null
   */
  private $id = null;

  public function __construct(){

  }

  /**
   * @return string
   */
  public function setOwnerIdESfield(string $ownerId){
    $this->fields[self::$ownerIdKey] = $ownerId;
    return $this;
  }

  /**
   * @param string $ownerId
   */
  public function getOwnerIdESfield():string{
    return $this->fields[self::$ownerIdKey];
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
  public function setESId(string $id) {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getESId(): string {
    return $this->id;
  }

  /**
   * @param array $arr
   *
   * @return mixed|void
   */
  public function setESFields(array $arr) {
    $this->fields = $arr;
  }

  /**
   * @param string $key
   * @param string $value
   *
   * @return mixed|void
   */
  public function addSetESField(string $key, $value) {
    $this->fields[$key] = $value;
  }

  /**
   * @return array
   */
  public function getESFields(): array {
    return $this->fields;
  }

  /**
   * @param string $key
   *
   * @return string
   */
  public function getESFieldValue(string $key) {
    return $this->fields[$key];
  }

}
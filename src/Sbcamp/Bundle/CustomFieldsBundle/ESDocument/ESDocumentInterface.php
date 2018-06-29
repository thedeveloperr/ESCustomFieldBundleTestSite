<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\ESDocument;

interface ESDocumentInterface {

  /**
   * @return string
   */
  public static function getIndex(): string;

  /**
   * @return string
   */
  public function getType(): string;

  /**
   * @param $id
   */
  public function setESId(string $id);

  /**
   * @return string
   */
  public function getESId();

  /**
   * @param array $arr
   *
   * @return mixed
   */
  public function setESFields(array $arr);

  /**
   * @return array
   */
  public function getESFields(): array;

  /**
   * @param string $key
   * @param mixed $value
   *
   * @return mixed
   */
  public function addSetESField(string $key, $value);

  /**
   * @param string $key
   *
   * @return mixed
   */
  public function getESFieldValue(string $key);

}
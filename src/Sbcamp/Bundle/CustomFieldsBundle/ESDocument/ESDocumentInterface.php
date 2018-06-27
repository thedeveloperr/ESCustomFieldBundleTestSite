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
  public function setId(string $id);

  /**
   * @return string
   */
  public function getId(): string;

  /**
   * @param array $arr
   *
   * @return mixed
   */
  public function setFields(array $arr);

  /**
   * @return array
   */
  public function getFields(): array;

  /**
   * @param string $key
   * @param string $value
   *
   * @return mixed
   */
  public function setFieldValue(string $key, string $value);

  /**
   * @param string $key
   *
   * @return string
   */
  public function getFieldValue(string $key): string;

}
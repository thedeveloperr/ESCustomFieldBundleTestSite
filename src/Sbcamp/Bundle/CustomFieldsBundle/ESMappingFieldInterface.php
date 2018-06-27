<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

interface ESMappingFieldInterface {

  /**
   * @return null|string
   */
  public function getFieldName(): ?string;

  /**
   * @param string $fieldName
   *
   * @return mixed
   */
  public function setFieldName(string $fieldName);

  /**
   * @return null|string
   */
  public function getDatatype(): ?string;

  /**
   * @param string $datatype
   *
   * @return mixed
   */
  public function setDatatype(string $datatype);

}
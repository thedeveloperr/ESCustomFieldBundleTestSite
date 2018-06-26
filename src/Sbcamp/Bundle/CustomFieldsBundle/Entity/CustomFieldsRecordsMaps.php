<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sbcamp\Bundle\CustomFieldsBundle\CustomFieldInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="custom_fields_records_maps",indexes={@ORM\Index(name="search_idx",columns={"owner_id","datatype"})})
 */
class CustomFieldsRecordsMaps {

  /**
   * @ORM\Id()
   * @ORM\Column(type="string", length=255)
   */
  private $ownerId;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $fieldName;

  /**
   * @ORM\Id()
   * @ORM\Column(type="string", length=255)
   */
  private $machineFieldName;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $datatype;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $esFieldName;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $configs;

  public function __construct(CustomFieldInterface $customField) {
    $this->ownerId = $customField->getOwnerId();
    $this->fieldName = $customField->getName();
    $this->datatype = $customField->getType();
    $this->machineFieldName = self::createMachineFieldName($this->fieldName);
  }

  /**
   * @param $fieldName
   *
   * @return string
   */
  public static function createMachineFieldName($fieldName): string {

    $temp = array_map(function($item) {
      return trim(strtolower($item));
    }, explode(" ", $fieldName));
    return implode("_", $temp);
  }

  public function getId() {
    return $this->id;
  }

  public function getOwnerId(): ?string {
    return $this->ownerId;
  }

  public function setOwnerId(string $ownerId): self {
    $this->ownerId = $ownerId;

    return $this;
  }

  public function getFieldName(): ?string {
    return $this->fieldName;
  }

  public function setFieldName(string $fieldName): self {
    $this->fieldName = $fieldName;
    $this->machineFieldName = self::createMachineFieldName($fieldName);
    return $this;
  }

  public function getMachineFieldName(): ?string {
    return $this->machineFieldName;
  }

  public function getDatatype(): ?string {
    return $this->datatype;
  }

  public function setDatatype(string $datatype): self {
    $this->datatype = $datatype;

    return $this;
  }

  public function getEsFieldName(): ?string {
    return $this->esFieldName;
  }

  public function setEsFieldName(string $esFieldName): self {
    $this->esFieldName = $esFieldName;

    return $this;
  }
}

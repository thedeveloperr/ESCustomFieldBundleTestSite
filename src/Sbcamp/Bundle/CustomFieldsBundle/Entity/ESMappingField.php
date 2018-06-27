<?php
namespace Sbcamp\Bundle\CustomFieldsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sbcamp\Bundle\CustomFieldsBundle\ESMappingFieldInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="esmapping_field",indexes={@ORM\Index(name="esmapping_field_index",columns={"field_name","datatype"})})
 */
class ESMappingField implements ESMappingFieldInterface
{


  /**
   * @ORM\Id()
   * @ORM\Column(type="string", length=50)
   */
  private $fieldName;

  /**
   * @ORM\Column(type="string", length=50)
   */
  private $datatype;


  public function getFieldName(): ?string
  {
    return $this->fieldName;
  }

  public function setFieldName(string $fieldName): self
  {
    $this->fieldName = $fieldName;

    return $this;
  }

  public function getDatatype(): ?string
  {
    return $this->datatype;
  }

  public function setDatatype(string $datatype): self
  {
    $this->datatype = $datatype;

    return $this;
  }
}

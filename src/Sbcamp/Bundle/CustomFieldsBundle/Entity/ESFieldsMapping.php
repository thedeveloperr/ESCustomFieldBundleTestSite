<?php
namespace Sbcamp\Bundle\CustomFieldsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="esfields_mapping",indexes={@ORM\Index(name="esfieldsmap_index",columns={"field_name","datatype"})})
 */
class ESFieldsMapping
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

    public function getId()
    {
        return $this->id;
    }

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

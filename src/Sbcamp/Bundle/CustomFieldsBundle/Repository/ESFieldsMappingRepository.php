<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\Repository;

use Sbcamp\Bundle\CustomFieldsBundle\Entity\ESMappingField;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Repository for CRUD on ESMappingField Entity
 *
 * @method ESMappingField|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method ESMappingField|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method ESMappingField[]    findAll()
 * @method ESMappingField[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ESMappingFieldRepository {

  /**
   * @var EntityRepository
   */
  private $repo;

  /**
   * @var EntityManagerInterface
   */
  private $em;

  public function __construct(EntityManagerInterface $em) {
    $this->em = $em;
    $this->repo = $em->getRepository(ESMappingField::class);
  }

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return ESMappingField[]
   */
  public function fetchESFieldNamesByDataype(string $datatype): array {
    return $this->repo->createQueryBuilder('esm')
                      ->select('fieldName')
                      ->andWhere('esm.datatype = :datatype')
                      ->setParameter("datatype", $datatype)
                      ->getQuery()
                      ->getArrayResult();
  }

  /**
   * @param ESMappingField $ESMappingField
   */
  public function insert(ESMappingField $ESMappingField) {
    $this->em->persist($ESMappingField);
    $this->em->flush();
  }

}

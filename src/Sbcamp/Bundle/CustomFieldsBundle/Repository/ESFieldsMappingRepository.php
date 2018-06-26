<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\Repository;

use Sbcamp\Bundle\CustomFieldsBundle\Entity\ESFieldsMapping;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Repository for CRUD on ESFieldsMapping Entity
 *
 * @method ESFieldsMapping|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method ESFieldsMapping|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method ESFieldsMapping[]    findAll()
 * @method ESFieldsMapping[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class ESFieldsMappingRepository {

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
    $this->repo = $em->getRepository(ESFieldsMapping::class);
  }

  /**
   * @param string $ownerId
   * @param string $datatype
   *
   * @return ESFieldsMapping[]
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
   * @param ESFieldsMapping $esFieldsMapping
   */
  public function insert(ESFieldsMapping $esFieldsMapping) {
    $this->em->persist($esFieldsMapping);
    $this->em->flush();
  }

}

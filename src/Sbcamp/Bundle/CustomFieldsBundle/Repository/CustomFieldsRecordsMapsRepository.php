<?php

namespace Sbcamp\Bundle\CustomFieldsBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Sbcamp\Bundle\CustomFieldsBundle\Entity\CustomFieldsRecordsMaps;
use Doctrine\ORM\EntityRepository;

/**
 * @method CustomFieldsRecordsMaps|null find($id, $lockMode = NULL, $lockVersion = NULL)
 * @method CustomFieldsRecordsMaps|null findOneBy(array $criteria, array $orderBy = NULL)
 * @method CustomFieldsRecordsMaps[]    findAll()
 * @method CustomFieldsRecordsMaps[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
 */
class CustomFieldsRecordsMapsRepository {

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
    $this->repo = $em->getRepository(CustomFieldsRecordsMaps::class);
  }

  /**
   * @param CustomFieldsRecordsMaps $customFieldsRecordsMaps
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function insert(CustomFieldsRecordsMaps $customFieldsRecordsMaps) {
    $this->em->persist($customFieldsRecordsMaps);
    $this->em->flush();
  }

  /**
   * @param string $ownerId
   * @param string $machineFieldName
   *
   * @return CustomFieldsRecordsMaps
   * @throws NonUniqueResultException
   */
  public function fetchByCompositeId(string $ownerId, string $machineFieldName): CustomFieldsRecordsMaps {
    return $this->repo->createQueryBuilder('cm')
                      ->where('cm.ownerId = :ownerId')
                      ->andWhere('cm.machineFieldName = :machineFieldName')
                      ->setParameter('ownerId', $ownerId)
                      ->setParameter("machineFieldName", $machineFieldName)
                      ->getQuery()
                      ->getOneOrNullResult();
  }

  /**
   * @param $ownerId
   * @param $datatype
   *
   * @return mixed
   * @throws NonUniqueResultException
   */
  public function countDatatypesUsed(string $ownerId, string $datatype): int {

    return (int) $this->repo->createQueryBuilder("cm")
                            ->select("count(cm.ownerId)")
                            ->andWhere('cm.ownerId = :ownerId')
                            ->andWhere('cm.datatype = :datatype')
                            ->setParameter('ownerId', $ownerId)
                            ->setParameter("datatype", $datatype)
                            ->getQuery()
                            ->getSingleScalarResult();
  }

  /**
   * @param $ownerId
   * @param $machineFieldName
   *
   * @return bool
   * @throws NonUniqueResultException
   */
  public function isFieldNameInUse(string $ownerId, string $machineFieldName) {


    return !is_null($this->repo->createQueryBuilder('cm')
                               ->andWhere('cm.ownerId = :ownerId')
                               ->andWhere('cm.machineFieldName = :machineFieldName')
                               ->setParameter('ownerId', $ownerId)
                               ->setParameter("machineFieldName", $machineFieldName)
                               ->getQuery()
                               ->getOneOrNullResult());
  }

  /**
   * @param string $ownerId
   * @param string $machineFieldName
   *
   * @return mixed
   * @throws NonUniqueResultException
   * @throws \Doctrine\ORM\NoResultException
   */
  public function fetchESFieldName(string $ownerId, string $machineFieldName) {


    return $this->repo->createQueryBuilder('cm')
                      ->select('cm.esFieldName')
                      ->andWhere('cm.ownerId = :ownerId')
                      ->andWhere('cm.machineFieldName = :machineFieldName')
                      ->setParameter('ownerId', $ownerId)
                      ->setParameter("machineFieldName", $machineFieldName)
                      ->getQuery()
                      ->getSingleScalarResult();
  }

  /**
   * @param $ownerId
   * @param $datatype
   *
   * @return array
   */
  public function fetchESFieldNamesInUse(string $ownerId, string $datatype) {
    return array_column($this->repo->createQueryBuilder('cm')
                                   ->select('cm.esFieldName')
                                   ->andWhere('cm.ownerId = :ownerId')
                                   ->andWhere('cm.datatype = :datatype')
                                   ->setParameter('ownerId', $ownerId)
                                   ->setParameter("datatype", $datatype)
                                   ->getQuery()
                                   ->getArrayResult(), 'esFieldName');
  }

  /**
   * @param string $ownerId
   *
   * @return CustomFieldsRecordsMaps[]
   */
  public function fetchCustomFieldsRecordOfOwner(string $ownerId) {
    return $this->repo->createQueryBuilder('cm')
                      ->where('cm.ownerId = :ownerId')
                      ->setParameter('ownerId', $ownerId)
                      ->getQuery()
                      ->getResult();
  }

  /**
   * @param string $ownerId
   * @param string $ESfieldName
   *
   * @return mixed
   * @throws NonUniqueResultException
   * @throws \Doctrine\ORM\NoResultException
   */
  public function fetchCustomFieldsRecordByEsFieldName(string $ownerId, string $ESfieldName) {
    return $this->repo->createQueryBuilder('cm')
                      ->where('cm.ownerId = :ownerId')
                      ->andWhere('cm.esFieldName = :esfname')
                      ->setParameter('ownerId', $ownerId)
                      ->setParameter('esfname', $ESfieldName)
                      ->getQuery()
                      ->getSingleResult();
  }

}
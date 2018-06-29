<?php

namespace Sbcamp\Bundle\CustomFieldsBundle;

use Doctrine\ORM\EntityManagerInterface;

abstract class DoctrineEntityManagerSharingParentService{

  public function __construct(EntityManagerInterface $em) {
  }
}


<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository
{
//    public function findAll(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function findAll()
	{
//		$qb = $this->_em->createQueryBuilder();
		$this->findAll(array());
	}
}

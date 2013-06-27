<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;


abstract class AbstractRepository extends EntityRepository
{
	public function getTotalCount(array $criteria = array())
	{
		
	}
}

<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;


abstract class AbstractRepository extends EntityRepository
{
	
	/**
	 * 
	 * @param array $conditions
	 * @return string
	 */
	protected function _getWherePart(array $conditions)
	{
		$where = '1=1';
		foreach ($conditions as $condition)
		{
			
		}
		return $where;
	}
}

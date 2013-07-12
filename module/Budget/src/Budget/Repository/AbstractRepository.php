<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractRepository extends EntityRepository
{
	
	/**
	 * 
	 * @param array $conditions
	 * @param \Doctrine\ORM\QueryBuilder $qb
	 * @return \Budget\Repository\AbstractRepository
	 * @throws Exception
	 */
	protected function _setWherePart(array $conditions, QueryBuilder $qb)
	{
		$where = $qb->expr()->andX("1=1");
		$param_placeholder_id = 1;
		$param_placeholder_prefix = ':where_';
		
		foreach ($conditions as $property => $data)
		{
			if (is_scalar($data)) {
				
				$where->add($qb->expr()->eq("main.{$property}", $param_placeholder_prefix . $param_placeholder_id));
				$qb->setParameter($param_placeholder_prefix . $param_placeholder_id, $data);
				$param_placeholder_id++;
				
			} else if(is_array($data)) {
				
				// Check if filter is of query type like combobox querying
				if (isset($data['property'])) {
					if (!empty($data['query'])) {
						$field = $data['property'];
						$value = $data['query'] . '%';
						
						$where->add($qb->expr()->like("main.{$field}", $param_placeholder_prefix . $param_placeholder_id));
						$qb->setParameter($param_placeholder_prefix . $param_placeholder_id, $value);
					} else {
						// Query was empty so return all items without filtering
						return $this;
					}
					
				} else {
				
					// Build custom multi filter where clause
					foreach ($data as $field => $cond_data) 
					{
						$oper = (isset($cond_data['oper'])) ? $cond_data['oper'] : 'eq';

						if (isset($cond_data['value'])) {
							$value = $cond_data['value'];
						} else {
							throw new \Exception("No filter condition value set!");
						}

						$where->add($qb->expr()->$oper("main.{$field}", $param_placeholder_prefix . $param_placeholder_id));

						$qb->setParameter($param_placeholder_prefix . $param_placeholder_id, $value);
						$param_placeholder_id++;
					}
				}
			} else {
				throw new Exception("Malformed condition structure!");
			}
		}
		$qb->where($where);
		return $this;
	}
}

<?php

namespace Budget\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;


class TransactiontypeRepository extends AbstractRepository
{
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		
		$order_property = (isset($orderBy['property'])) ? 'main.'.$orderBy['property'] : 'main.id';
		$order_direction = (isset($orderBy['direction']) && $orderBy['direction'] == 'DESC') ? 'DESC' : 'ASC';
		
		$qb = $this->_em->createQueryBuilder();
		$qb	->select('main')
			->from('Budget\Entity\Transactiontype', 'main')
//			->where($this->_getWherePart($criteria))
			->orderBy($order_property, $order_direction)
			->setFirstResult($offset)
			->setMaxResults($limit);
		
		$this->_setWherePart($criteria, $qb);
		
		$query = $qb->getQuery();
		
		$paginator = new Paginator($query, $fetchJoinCollection = true);
		
		return array(
			'result' => $paginator,
			'total' => $paginator->count()
		);
	}
}

<?php

namespace Budget\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

class TransactionRepository extends AbstractRepository
{
//    public function findAll(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$order_property = (isset($orderBy['property'])) ? $orderBy['property'] : 'main.id';
		$order_direction = (isset($orderBy['direction']) && $orderBy['direction'] == 'DESC') ? 'DESC' : 'ASC';
		
		$qb = $this->_em->createQueryBuilder();
		$qb	->select('main, c, u, tt')
			->from('Budget\Entity\Transaction', 'main')
			->leftJoin('main.company', 'c')
			->leftJoin('main.user', 'u')
			->leftJoin('main.type', 'tt')
			->where($this->_getWherePart($criteria))
			->orderBy($order_property, $order_direction)
			->setFirstResult($offset)
			->setMaxResults($limit);
		
		$query = $qb->getQuery();
		
		$paginator = new Paginator($query, $fetchJoinCollection = true);
		
		return array(
			'result' => $paginator,
			'total' => $paginator->count()
		);
	}
}

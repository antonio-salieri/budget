<?php

namespace Budget\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

class TransactionRepository extends AbstractRepository
{
//    public function findAll(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$order_property = (isset($orderBy['property'])) ? 'main.'.$orderBy['property'] : 'main.id';
		$order_direction = (isset($orderBy['direction']) && $orderBy['direction'] == 'DESC') ? 'DESC' : 'ASC';
		
		$qb = $this->_em->createQueryBuilder();
		$qb	->select('main, c, u, tt')
			->from('Budget\Entity\Transaction', 'main')
			->leftJoin('main.company', 'c')
			->leftJoin('main.user', 'u')
			->leftJoin('main.type', 'tt')
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
	
	public function getTotals($criteria = array())
	{
		$qb = $this->_em->createQueryBuilder();
//		$qb	->select('COALESCE(SUM(main.income),0) income, COALESCE(SUM(main.outcome),0) outcome, COALESCE(SUM(main.income),0) - COALESCE(SUM(main.outcome),0) balance')
		$qb	->select('SUM(main.income) income, SUM(main.outcome) outcome')
			->from('Budget\Entity\Transaction', 'main')
			->leftJoin('main.company', 'c')
			->leftJoin('main.user', 'u')
			->leftJoin('main.type', 'tt');
//			->where($this->_getWherePart($criteria));
		
		$this->_setWherePart($criteria, $qb);
		
		$qb->andWhere('main.stornoTime IS NULL');
		
		$query = $qb->getQuery();
		$result = $query->getResult();
		
		$totals['income'] = (float) $result[0]['income'];
		$totals['outcome'] = (float) $result[0]['outcome'];
		$totals['balance'] = $totals['income'] - $totals['outcome'];
		return $totals;
	}
}

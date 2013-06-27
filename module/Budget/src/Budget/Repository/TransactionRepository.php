<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
//use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query;


class TransactionRepository extends AbstractRepository
{
//    public function findAll(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		
		$qb = $this->_em->createQueryBuilder();
		$qb	->select('t transaction, c.id company, u.id user, tt.id type')
			->from('Budget\Entity\Transaction', 't')
			->leftJoin('t.company', 'c')
			->leftJoin('t.user', 'u')
			->leftJoin('t.type', 'tt');
		
		$transactions = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
		
		$result = array();
		// Repack resulting array to start from index 0 this is doen for json_encode :(
		foreach ($transactions as $key => $transaction_data) {
			$result[$key] = $transaction_data['transaction'];
			$result[$key]['company'] = $transaction_data['company'];
			$result[$key]['user'] = $transaction_data['user'];
			$result[$key]['type'] = $transaction_data['type'];
		}
		return $result;
	}
}

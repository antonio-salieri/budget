<?php

namespace Budget\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
//use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query;


class UserRepository extends EntityRepository
{
//    public function findAll(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		
		$qb = $this->_em->createQueryBuilder();
		$qb	->select('u user, c.id company')
			->from('Budget\Entity\User', 'u')
			->leftJoin('u.companies', 'c');
		
		$users_raw = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
		
		$users = array();
		foreach ($users_raw as $user_data)
		{
			$user_id = $user_data['user']['id'];
			
			if (!isset($users[$user_id])) {
				$users[$user_id] = $user_data['user'];
			}
			
			if (!isset($users[$user_id]['companies'])) {
				$users[$user_id]['companies'] = array();
			}	
			$users[$user_id]['companies'][] = $user_data['company'];
		}
		// Repack resulting array to start from index 0 this is doen for json_encode :(
		$result = array();
		foreach ($users as $user) {
			$result[] = $user;
		}
		return $result;
		
		/*
		 * TEST CODE FOLLOWS
		 */
//		$qb = $this->_em->createQueryBuilder();
//		$qb	->add('select', 'u, c.id')
//			->add('from', 'User u')
//				// $qb->expr()->andx($qb->expr()->eq('p.user_id', 'u.id'), $qb->expr()->eq('p.country_code', '55'))
//			->add('leftJoin', 'u.Companies c')
//			->add('where', $qb->expr()->andX($criteria))
//			->add('orderBy', $qb->expr()->orderBy($orderBy))
//			->setFirstResult($offset)
//			->setMaxResults($limit);
//		$query = $this->_em->createQuery("
//			SELECT u, c
//			FROM Budget\Entity\User u 
//			LEFT JOIN u.companies c");
//			$users = $query->getResult(Query::HYDRATE_OBJECT);
			
//			$rsm = new ResultSetMapping();
//			$query = $this->_em->createNativeQuery('
//				SELECT u.*, luc.company_id 
//				FROM user u 
//				LEFT JOIN link_user_company luc 
//					ON luc.user_id = u.id', $rsm
//			);
//			
//			$users = $query->getResult();
//			var_dump($rsm);die;
//			var_dump($users);die;
//			
//			foreach ($users as $user)
//			{
////				var_dump($user['companies']->getValues());die;
////				var_dump($user);die;
//				$user->getCompanies();
//			}
//			var_dump($users);die;
//			return $users;
	}
}

<?php

namespace Budget\Service;

use Budget\Entity\Company;
use Doctrine\Common\Collections\ArrayCollection;

class UserService extends AbstractBudgetService
{
	protected $_entity_name = 'Budget\Entity\User';

	public function getUserCompanies($user_id)
	{
		if (!isset($user_id))
		{
			throw new \Exception('No entity id passed for update.');
		}
		
		$entity  = $this->getRepository()->findOneById($user_id);
		return $entity->getCompanies();
	}
	
	public function findAll($return_entities = true, $json = false, array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$result = parent::findAll($return_entities, $json, $criteria, $orderBy, $limit, $offset);
//		var_dump($result);die;
//		$collection = new ArrayCollection($result);
//		var_dump($collection);die;
//		foreach ($result as $entity)
//		{
//			$entity->getCompanies();
//		}
		return $result;
	}
}

<?php

namespace Budget\Service;

use Budget\Entity\Company;
use Doctrine\Common\Collections\ArrayCollection;

class UserService extends AbstractBudgetService
{
	protected $_entity_name = 'Budget\Entity\User';

//	public function getUserCompanies($user_id)
//	{
//		if (!isset($user_id))
//		{
//			throw new \Exception('No entity id passed for update.');
//		}
//		
//		$entity  = $this->getRepository()->findOneById($user_id);
//		return $entity->getCompanies();
//	}
	
	protected function _fillEntityCollections($entity, $data)
	{
		/*
		 * Fill companies
		 */
		$company_ids = (isset($data['companies'])) ? $data['companies'] : array();
		$companies = $entity->getCompanies();
		
		$companies->clear();
		foreach($company_ids as $company_id)
		{
			$company = $this->getObjectManager()->find('Budget\Entity\Company', $company_id);
			$companies->add($company);
		}
		
		return parent::_fillEntityCollections($entity, $data);
	}
	
}

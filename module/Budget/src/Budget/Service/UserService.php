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
	
	protected function _fillEntity($entity, array $data)
	{
		$companies = $data['companies'];
		if (!is_array($companies)) {
			$companies = array();
		}
		unset($data['companies']);
		
		parent::_fillEntity($entity, $data);
		
		/** @var Doctrine\Common\Collections\ArrayCollection */
		$current_companies = $entity->getCompanies();
		$current_company_ids = array();
		foreach ($current_companies as $company) {
			$_company_id = $company->getId();
			if (!in_array($_company_id, $companies)) {
				$current_companies->remove($_company_id);
			} else {
				$current_company_ids[] = $_company_id;
			}
		}
		foreach ($companies as $company_id) {
			$company = $this->getObjectManager()->find('Budget\Entity\Company', $company_id);
			if ($company && !in_array($company_id, $current_company_ids)) {
				$entity->getCompanies()->add($company);
			}
		}
	}
}

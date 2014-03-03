<?php

namespace Budget\Service;

class CompanyService extends AbstractBudgetService
{
	protected $_entity_name = 'Budget\Entity\Company';

	public function add(array $data, $flush = true)
	{
		if (isset($data['is11']) && $data['is11']) {
			$company_data = $this->getRepository()->findBy(array('is11' => true));
			$companies = $company_data['result'];
			foreach ($companies as $company) {
				$company->setIs11(false);
				$this->getObjectManager()->persist($company);
			}
		}
		parent::add($data);
	}
	
	public function update(array $data, $flush = true)
	{
		if (isset($data['is11'])  && $data['is11']) {
			$company_data = $this->getRepository()->findBy(array('is11' => 1));
			$companies = $company_data['result'];
			foreach ($companies as $company) {
				$company->setIs11(false);
				$this->getObjectManager()->persist($company);
			}
		}
		parent::update($data);
	}
}

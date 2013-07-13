<?php

namespace Budget\Service;

use Budget\Entity\TransactionType;
use Doctrine\Common\Collections\ArrayCollection;

class TransactiontypeService extends AbstractBudgetService
{
	protected $_entity_name = 'Budget\Entity\TransactionType';

	public function add(array $data, $flush = true)
	{
		$this->_maintainTaxResolvers($data);
		parent::add($data);
	}
	
	public function update(array $data, $flush = true)
	{
		$this->_maintainTaxResolvers($data);
		parent::update($data);
	}
	
	private function _maintainTaxResolvers(array $data)
	{
		if (isset($data['isTaxResolver']) && $data['isTaxResolver']) {
			$type = isset($data['isTaxResolver']) ? $data['isTaxResolver'] : TransactionType::OUTCOME_TYPE;
			
			$transaction_type_data = $this->getRepository()->findBy(
				array(
					'isTaxResolver' => true, 
					'type' => $type
				)
			);
			$transaction_types = $transaction_type_data['result'];
			foreach ($transaction_types as $transaction_type) {
				$transaction_type->setIsTaxResolver(false);
				$this->getObjectManager()->persist($transaction_type);
			}
		}
		$this->getObjectManager()->flush();
		return $this;
	}
	
	public function getTaxResolverType(TransactionType $transaction_type)
	{
		$type = ($transaction_type->getType() == TransactionType::INCOME_TYPE) ? 
				TransactionType::OUTCOME_TYPE : TransactionType::INCOME_TYPE;
		return $this->getRepository()->findOneBy(array(
			'isTaxResolver' => true,
			'type' => $type
		));
	}
}

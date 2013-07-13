<?php

namespace Budget\Service;

use Budget\Entity\Transaction;
use Budget\Entity\TransactionType;
use Budget\Entity\BudgetEntityInterface;

class TransactionService extends AbstractBudgetService
{
	protected $_entity_name = 'Budget\Entity\Transaction';
	protected $_entity_relations = array(
		'type' => array(
			'entity' => 'Budget\Entity\Transactiontype'
		),
		'user' => array(
			'entity' => 'Budget\Entity\User'
		),
		'company' => array(
			'entity' => 'Budget\Entity\Company'
		)
	);
	
	public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$result = parent::findBy($criteria, $orderBy, $limit, $offset);
		
		$result['totals_data'] = $this->getTotalsData($criteria);
		
		return $result;
	}
	
	private function getTotalsData($criteria)
	{
		return $this->getRepository()->getTotals($criteria);
	}


	public function add(array $data, $flush = true)
	{
		// Ensure that is11 flag is false for user created transaction
		$data['is11'] = false;
		
		$original_note = $data['note'];
		
		/** @var Budget\Entity\Transaction */
		$transaction = parent::add($data, false);
		
		if ($transaction instanceof Transaction) {
			$transaction_type = $transaction->getType();
		
			/*
			 * Resolve TAX
			 */
			if ($transaction->getType()->getResolveTaxAutomatically()) {
				$data['type'] = $this->_getAutoResolveTaxType($transaction_type)->getId();

				if ($transaction_type->getType() == TransactionType::OUTCOME_TYPE) {
					$data['income'] = $transaction->getOutcome() * Transaction::TAX_PERCENT / 100;
					$data['outcome'] = null;
				} else {
					$data['outcome'] = $transaction->getIncome() * Transaction::TAX_PERCENT / 100;
					$data['income'] = null;
				}


				$data['note'] = "
Automated note:
>>>>>>>>>>>>>>>>
This is automatically created entry for Tax resolving, i.e. generating
entries for Tax returning, for some outcome types and Tax payment for some
income types
>>>>>>>>>>>>>>>>

Original note:
" . $original_note;
				parent::add($data, false);
			}
		
		
			/*
			 * Resolve 1:1 conto
			 */
			if ($transaction_type->getIs11()) {
				$data['type'] = $transaction->getType()->getId();
				$data['income'] = $transaction->getIncome();
				$data['outcome'] = $transaction->getOutcome();
				
				$company_11 = $this->getObjectManager()->getRepository('Budget\Entity\Company')->get11Company();
				$data['company'] = $company_11->getId();
				$data['is11'] = true;
				$data['note'] = "
Automated note:
>>>>>>>>>>>>>>>>
This is automatically created transaction regarding 1:1 rule.'
>>>>>>>>>>>>>>>>

Original note:
" . $original_note;

				parent::add($data, false);
			}
		}
		
		
		$this->getObjectManager()->flush();
		return $transaction;
	}
	
	
	/**
	 * 
	 * @param \Budget\Entity\TransactionType $transaction_type
	 * @return \Budget\Entity\TransactionType
	 */
	private function _getAutoResolveTaxType(TransactionType $transaction_type)
	{
		return $this->getServiceLocator()
					->get('budget.service.transactiontype')
					->getTaxResolverType($transaction_type);		
	}


	/**
	 * Disable transactions deleting
	 * @param type $id
	 * @return \Budget\Service\TransactionService
	 */
	public function delete($id, $flush = true)
	{
		throw new Exception("Delete of transactions is forbidden!");
	}
	
	/**
	 * Disable transactions updateing
	 * 
	 * @param array $data
	 * @return \Budget\Service\TransactionService
	 */
	public function update(array $data, $flush = true)
	{
		throw new Exception("Update of transactions is forbidden!");
	}
}

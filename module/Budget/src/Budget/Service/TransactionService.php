<?php

namespace Budget\Service;

use Budget\Entity\Transaction;
use Budget\Entity\TransactionType;
use Budget\Entity\Company;
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
		$transaction = parent::add($data, true);
		
		if ($transaction instanceof Transaction) {
			$transaction_type = $transaction->getType();
			$transaction_id = $transaction->getId();

			/*
			 * Resolve TAX
			 */
			if ($transaction_type->getResolveTaxAutomatically()) {
				$data['linkedTransactionId'] = $transaction_id;
				
				$resolving_type = $this->_getAutoResolveTaxType($transaction_type);
				
				if (! ($resolving_type instanceof TransactionType))
				{
					throw new \Exception("Error creating TAX autoresolve entry. Tax resolve transaction type is not set!");
				}
				
				$data['type'] = $resolving_type->getId();
				
				if ($transaction_type->getType() == TransactionType::OUTCOME_TYPE) {
					$data['income'] = $transaction->getOutcome() - $transaction->getOutcome() * (100 / ( Transaction::TAX_PERCENT + 100 ));
					$data['outcome'] = null;
				} else {
					$data['outcome'] = $transaction->getIncome() - $transaction->getIncome() * (100 / ( Transaction::TAX_PERCENT + 100 ));
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
				$data['linkedTransactionId'] = $transaction_id;

				$data['type'] = $transaction->getType()->getId();
				$data['income'] = null;
				$data['outcome'] = $transaction->getOutcome();
				
				
				if ($transaction_type->getResolveTaxAutomatically())
				{
					$data['outcome'] = $transaction->getOutcome() * (100 / ( Transaction::TAX_PERCENT + 100 ));
				}
				
				$company_11 = $this->getObjectManager()->getRepository('Budget\Entity\Company')->get11Company();
                if (! ($company_11 instanceof Company))
				{
					throw new \Exception("Error creating 1:1 entry. 1:1 company is not set!");
				}
				$data['company'] = $company_11->getId();
				$data['is11'] = true;
				$data['note'] = "
Automated note:
>>>>>>>>>>>>>>>>
This is automatically created transaction regarding 1:1 rule.
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
		parent::delete($id, $flush);
	}
	
	private function storno($id, $flush)
	{
		$this->_storno($id, $flush);
	}
	private function _storno($id, $flush)
	{
		/** @var Budget\Entity\Transaction */
		$entity  = $this->getRepository()->findOneById($id);
		$storno_time = new \DateTime();
		if ($entity) {
			$entity->setStornoTime($storno_time);
		}
		
		/*
		 * Storno linked transactions
		 */
		$linked_transactions = $this->getRepository()->findBy(array('linkedTransactionId' => $id));
		foreach ($linked_transactions['result'] as $transaction) {
			$transaction->setStornoTime($storno_time);
		}
		
		if ($flush) {
			$this->getObjectManager()->flush();
		}
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

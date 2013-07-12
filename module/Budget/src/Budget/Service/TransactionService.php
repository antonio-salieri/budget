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
		
		/** @var Budget\Entity\Transaction */
		$transaction = parent::add($data, false);
		if ($transaction instanceof Transaction) {
			if ($transaction->getType()->getIs11()) {
				$company_11 = $this->getObjectManager()->getRepository('Budget\Entity\Company')->get11Company();
				$transaction_id = $transaction->getId();
				$data['company'] = $company_11->getId();
				$data['is11'] = true;
				$data['note'] = "
Automated note:
>>>>>>>>>>>>>>>>
This is automatically created transaction regarding 1:1 rule.'
>>>>>>>>>>>>>>>>

Original note:
" . $data['note'];

				parent::add($data, false);
			}
		}
		
		$this->getObjectManager()->flush();
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

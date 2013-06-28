<?php

namespace Budget\Service;

use Budget\Entity\Transaction;
use Doctrine\Common\Collections\ArrayCollection;

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
	
}

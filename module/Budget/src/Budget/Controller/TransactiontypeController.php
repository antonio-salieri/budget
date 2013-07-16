<?php
namespace Budget\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

// use Zend\View\Model\JsonModel;

class TransactiontypeController extends AbstractBudgetController
{
	
    public function indexAction()
    {
		parent::indexAction();
		
		try {
			/** @var Budget\Service\Transactiontype */
			$service = $this->getServiceLocator()->get('budget.service.transactiontype');
			$result = $service->findBy($this->criteria, $this->order_by, $this->limit, $this->offset);
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage(),
				'result' => array()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'result' => $result['result'],
			'total' => $result['total']
		));
    }
	
	public function updateAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.transactiontype');
		
		try {
			$data = \Zend\Json\Decoder::decode(
				$this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY
			);
			$service->update(
				$data
			);
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'msg' => 'Transaction type edit succeeded'
		));
	}
	
	public function addAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.transactiontype');
		
		try {
			$data = \Zend\Json\Decoder::decode(
				$this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY
			);
			$service->add(
				$data
			);
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'msg' => 'Transaction type addition succeeded'
		));
	}
	
	public function deleteAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.transactiontype');
		
		try {
			$data = \Zend\Json\Decoder::decode(
				$this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY
			);
			$service->delete(
				$data['id']
			);
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'msg' => 'Transaction type removal succeeded'
		));
	}
}

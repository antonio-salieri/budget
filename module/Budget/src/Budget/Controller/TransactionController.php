<?php
namespace Budget\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

// use Zend\View\Model\JsonModel;

class TransactionController extends AbstractBudgetController
{
	
    public function indexAction()
    {
		parent::indexAction();
		
		try {
			/** @var Budget\Service\TransactionService */
			$service = $this->getServiceLocator()->get('budget.service.transaction');
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
			'total' => $result['total'],
			'totals_data' => $result['totals_data']
		));
    }
	
	public function updateAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.transaction');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
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
			'msg' => 'Transaction edit succeeded'
		));
	}
	
	public function addAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.transaction');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
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
			'msg' => 'Transaction addition succeeded'
		));
	}
	
	public function deleteAction()
	{
		/** @var Budget\Service\TransactionService */
		$service = $this->getServiceLocator()->get('budget.service.transaction');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
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
			'msg' => 'Transaction cancellation succeeded'
		));
	}
	
	public function stornoAction()
	{
		/** @var Budget\Service\TransactionService */
		$service = $this->getServiceLocator()->get('budget.service.transaction');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
			$service->storno(
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
			'msg' => 'Transaction cancellation succeeded'
		));
	}	
}

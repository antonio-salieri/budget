<?php
namespace Budget\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

// use Zend\View\Model\JsonModel;

class UserController extends AbstractActionController
{
//	private $acceptCriteria = array(
//		'Zend\View\Model\ViewModel' => array('text/html'),
//		'Zend\View\Model\JsonModel' => array('application/json'),
//		'Zend\View\Model\FeedModel' => array('application/rss+xml')
//	);
	
    public function indexAction()
    {
		$start = $this->getRequest()->getQuery('start', 0);
		$page_no = $this->getRequest()->getQuery('page', 1);
		$limit = $this->getRequest()->getQuery('limit', 25);
		
		try {
			/** @var Budget\Service\Company */
			$service = $this->getServiceLocator()->get('budget.service.user');
			$result = $service->findAll(false, false);
//$result = array('id'=>1, 'firstName'=>'Petar', 'lastName'=>'Petrović', 'companies'=>array(1,2));
//			var_dump($result);die;
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $this->translate($e->getMessage()),
				'result' => array()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'result' => $result
		));
    }
	
	public function updateAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.user');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
			$service->update(
				$data
			);
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage()
//				'msg' => $this->translate($e->getMessage())
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'msg' => 'Update succeeded'
//			'msg' => $this->translate('Uspešan update')
		));
	}
	
	public function addAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.user');
		
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
			'msg' => 'Addition succeeded'
		));
	}
	
	public function deleteAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.user');
		
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
			'msg' => 'Addition succeeded'
		));
	}
	
	/**
	 * @deprecated
	 * @return \Zend\View\Model\JsonModel
	 */
	public function companiesAction()
	{
		$service = $this->getServiceLocator()->get('budget.service.user');
		
		try {
			$data = \Zend\Json\Decoder::decode($this->getRequest()->getContent(), \Zend\Json\Json::TYPE_ARRAY);
			$user_companies = $service->getUserCompanies(
				$data['id']
			);
			var_dump($user_companies);die;
		} catch (\Exception $e) {
			return new JsonModel(array(
				'success' => false,
				'msg' => $e->getMessage()
			));
		}
		
		return new JsonModel(array(
			'success' => true,
			'result' => $user_companies,
			'msg' => 'Addition succeeded'
		));
	}
}

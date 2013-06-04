<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Budget\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

// use Zend\View\Model\JsonModel;

class CompanyController extends AbstractActionController
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
			$service = $this->getServiceLocator()->get('budget.service.company');
			$result = $service->findAll(false);
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
		$service = $this->getServiceLocator()->get('budget.service.company');
		
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
		$service = $this->getServiceLocator()->get('budget.service.company');
		
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
		$service = $this->getServiceLocator()->get('budget.service.company');
		
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
}

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

class CompanyController extends AbstractBudgetController
{
	
    public function indexAction()
    {
		
		try {
			/** @var Budget\Service\CompanyService */
			$service = $this->getServiceLocator()->get('budget.service.company');
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

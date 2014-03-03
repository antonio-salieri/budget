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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
//		var_dump($em);die;
		
//		$om = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
//		
//		$user = new \Budget\Entity\User();
//		$user	->setFirstName("Emmanuel")
//				->setLastName("Goldstein");
//		$om->persist($user);
//		$om->flush();
		
//		var_dump($om);
        return new ViewModel();
    }
	
    public function accountingAction()
    {
        return new ViewModel();
    }
	
    public function reportsAction()
    {
        return new ViewModel();
    }
	
    public function adminAction()
    {
        return new ViewModel();
    }
	
}

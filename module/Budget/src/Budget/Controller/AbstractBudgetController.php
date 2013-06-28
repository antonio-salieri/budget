<?php
namespace Budget\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

abstract class AbstractBudgetController extends AbstractActionController
{
//	private $acceptCriteria = array(
//		'Zend\View\Model\ViewModel' => array('text/html'),
//		'Zend\View\Model\JsonModel' => array('application/json'),
//		'Zend\View\Model\FeedModel' => array('application/rss+xml')
//	);
	
	protected $offset = null;
	protected $limit = null;
	protected $criteria = array();
	protected $order_by = array();
	
	
    public function indexAction()
    {
//		$this->page_no = $this->getRequest()->getQuery('page', 1);
		$this->offset = $this->getRequest()->getQuery('start', 0);
		$this->limit = $this->getRequest()->getQuery('limit', 25);
		$this->criteria = array();
		$this->order_by = array();
    }
	
}

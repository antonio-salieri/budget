<?php
namespace Budget\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use \Zend\Json\Decoder as JsonDecoder;

abstract class AbstractBudgetController extends AbstractActionController
{
//	private $acceptCriteria = array(
//		'Zend\View\Model\ViewModel' => array('text/html'),
//		'Zend\View\Model\JsonModel' => array('application/json'),
//		'Zend\View\Model\FeedModel' => array('application/rss+xml')
//	);
	
	protected $page_no = null;
	protected $offset = null;
	protected $limit = null;
	protected $criteria = array();
	protected $order_by = array();
	
	
    public function indexAction()
    {
		$this->page_no = $this->getRequest()->getQuery('page', 1);
		$this->offset = $this->getRequest()->getQuery('start', 0);
		$this->limit = $this->getRequest()->getQuery('limit', 25);
		$this->criteria = JsonDecoder::decode($this->getRequest()->getQuery('filter', ''), \Zend\Json\Json::TYPE_ARRAY);
		
		if ($this->criteria === null) {
			$this->criteria = array();
		} else if(isset($this->criteria[0]['property'])) {
			$this->criteria[0]['query'] = $this->getRequest()->getQuery('query', '');
		}
		
		$sort_data = JsonDecoder::decode($this->getRequest()->getQuery('sort', ''), \Zend\Json\Json::TYPE_ARRAY);
		if ($sort_data === null) {
			$this->order_by = array();
		} else {
			$this->order_by = $sort_data[0];
		}
    }
	
}

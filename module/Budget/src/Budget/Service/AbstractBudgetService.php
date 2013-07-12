<?php

namespace Budget\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Budget\Entity\BudgetEntityInterface;

//use Doctrine\ORM\EntityManager;

abstract class AbstractBudgetService 
	implements ServiceLocatorAwareInterface
{
	
	protected $_serviceLocator = null;

	/**
	 * @var Doctrine\ORM\EntityRepository
	 */
	protected $_repository = null;
	/**
	 * @var string
	 */
	protected $_entity_name = null;
	
	/**
	 * @var array
	 */
	protected $_entity_relations = array();


	/**
	 * @var Doctrine\Common\Persistence\ObjectManager
	 */
	private static $_object_manager = null;

	public function __construct() {
	}


	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->_serviceLocator = $serviceLocator;
	}

	public function getServiceLocator() {
		return $this->_serviceLocator;
	}
	
	protected function getObjectManager()
	{
		if (self::$_object_manager === null)
		{
			self::$_object_manager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		
		return self::$_object_manager;
	}

	/**
	 * 
	 * @return Doctrine\ORM\EntityRepository
	 * @throws Exception
	 */
	protected function getRepository() 
	{
		if ($this->_repository === null)
		{
			if ($this->_entity_name === null)
			{
				throw new Exception('Undefined entity name');
			}
			$this->_repository = $this->getObjectManager()->getRepository($this->_entity_name);
		}
		return $this->_repository;
	}
	
	
	/**
	 * 
	 * @param array $criteria
	 * @param string $orderBy
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function findBy(array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$data = $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
		
		$total = $data['total'];
		
		$items = array();
		foreach ($data['result'] as $item)
		{
			$items[] = $this->_entityToStdClass($item);
		}
		
		return array(
			'total' => $total,
			'result' => $items
		);
	}
	
	/**
	 * 
	 * @param array $data
	 * @return Budget\Entity\BudgetEntityInterface
	 * @throws \Exception
	 */
	public function update(array $data, $flush = true)
	{
		if (!isset($data['id']))
		{
			throw new \Exception('No entity id passed for update.');
		}
		/** @var Budget\Entity\BudgetEntityInterface */
		$entity  = $this->getRepository()->findOneById($data['id']);
		$this->_fillEntity($entity, $data);
		if ($flush) {
			$this->getObjectManager()->flush();
		}
		
		return $entity;
	}
	
	/**
	 * 
	 * @param array $data
	 * @return Budget\Entity\BudgetEntityInterface
	 */
	public function add(array $data, $flush = true)
	{
		/** @var Budget\Entity\BudgetEntityInterface */
		$entity  = new $this->_entity_name;
		$this->_fillEntity($entity, $data);
		$this->getObjectManager()->persist($entity);
		if ($flush) {
			$this->getObjectManager()->flush();
		}
		return $entity;
	}
	
	public function delete($id, $flush = true)
	{
		$entity  = $this->getRepository()->findOneById($id);
		$this->getObjectManager()->remove($entity);
		if ($flush) {
			$this->getObjectManager()->flush();
		}
	}
	
	/**
	 * 
	 * @param type $entity
	 * @param array $data
	 */
	protected function _fillEntity($entity, array $data)
	{
		$reflector = new \ReflectionClass($entity);
		$properties   = $reflector->getProperties();

		foreach ($properties as $property)
		{
			$property->setAccessible(true);
			$property_name = $property->getName();
			if (strtolower($property_name) == 'id')
			{
				continue;
			}
			$property->setAccessible(false);
			if (isset($data[$property_name]))
			{
				$_base_method_name = implode('', array_map('ucfirst', explode('_', $property_name)));
				$get_method = "get" . $_base_method_name;
				$property = $entity->$get_method();
				
				$property_value = null;
				
				if ($property instanceof PersistentCollection ||
					$property instanceof ArrayCollection)
				{
					// Array collections are filled later within each entity service by method _fillEntityCollections()
					continue;
				} else if (isset($this->_entity_relations[$property_name])) {
					if (!isset($this->_entity_relations[$property_name]['entity'])) {
						throw new Exception("Bad configuration for entity relation property '{$this->_entity_relations[$property_name]}' of entity '" .  get_class($entity) . "'");
					}
						
					$property_value = $this->getObjectManager()->getRepository($this->_entity_relations[$property_name]['entity'])->find($data[$property_name]);
				} else {
					$property_value = $data[$property_name];
				}
				
				$set_method = "set" . $_base_method_name;
				$entity->$set_method($property_value);
			}
		}
		
		$this->_fillEntityCollections($entity, $data);
	}
	
	/**
	 * 
	 * @param type $entity
	 * @param type $data
	 * @return \Budget\Service\AbstractBudgetService
	 */
	protected function _fillEntityCollections($entity, $data)
	{
		return $this;
	}

	protected function _entityToStdClass($entity, $fetch_only_id = false)
	{
		
		if ($fetch_only_id && method_exists($entity, 'getId')) {
			return $entity->getId();
		}
		
		$reflector = new \ReflectionClass(get_class($entity));
		$props   = $reflector->getProperties();
		$obj = new \stdClass;

		foreach ($props as $property)
		{
			$property->setAccessible(true);
			$value = $property->getValue($entity);
			$name = $property->getName();

			$method_name = 'get' . implode('', array_map('ucfirst', explode('_', $name)));

			$prop_obj = null;
			if (method_exists($entity, $method_name))
			{
				$prop_obj = $entity->$method_name();
			}
			
			if ($prop_obj instanceof PersistentCollection)
			{
				$value = array();
				foreach ($prop_obj as $item){
					$value[] = $this->_entityToStdClass($item, true);
				}
			} else if ($prop_obj instanceof BudgetEntityInterface) {
				$value = $this->_entityToStdClass($prop_obj);
			}
			
			$obj->$name = $value;

			$property->setAccessible(false);
		}
		
		return $obj;
	}

}

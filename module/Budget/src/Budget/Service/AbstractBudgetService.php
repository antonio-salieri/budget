<?php

namespace Budget\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineORMModule\Service\EntityManagerFactory;
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
	 * @var Doctrine\Common\Persistence\ObjectManager
	 */
	protected static $_object_manager = null;

	public function __construct() {
//		var_dump(self::$entity_manager); die;
//		if (self::$entity_manager === null)
//		{
//			$facttory = new EntityManagerFactory('orm_default');
//			static::$entity_manager = $facttory->createService('');
//		}
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
	 * @param bool $return_entities
	 * @param bool $json
	 * @param array $criteria
	 * @param string $orderBy
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function findAll($return_entities = true, $json = false, array $criteria = array(), array $orderBy = null, $limit = null, $offset = null)
	{
		$result = $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
		if (!$return_entities)
		{
			$result = $this->_entityToStdClass($result);
			if ($json)
			{
				$result = \Zend\Json\Json::encode($result);
			}
		}
		return $result;
	}
	
	public function update(array $data)
	{
		if (!isset($data['id']))
		{
			throw new \Exception('No entity id passed for update.');
		}
		$entity  = $this->getRepository()->findOneById($data['id']);
		$this->_fillEntity($entity, $data);
		$this->getObjectManager()->flush();
	}
	
	public function add(array $data)
	{
		$entity  = new $this->_entity_name;
		$this->_fillEntity($entity, $data);
		$this->getObjectManager()->persist($entity);
		$this->getObjectManager()->flush();
	}
	
	public function delete($id)
	{
		$entity  = $this->getRepository()->findOneById($id);
		$this->getObjectManager()->remove($entity);
		$this->getObjectManager()->flush();
	}
	
	protected function _fillEntity($entity, array $data)
	{
		$reflector = new \ReflectionClass($entity);
		$props   = $reflector->getProperties();

		foreach ($props as $property)
		{
			$property->setAccessible(true);
			$name = $property->getName();
			if (strtolower($name) == 'id')
			{
				continue;
			}
			$property->setAccessible(false);
			if (isset($data[$name]))
			{
				$method = "set" .  implode('', array_map('ucfirst', explode('_', $name)));
				$entity->$method($data[$name]);
			}
		}
	}

	protected function _entityToStdClass(array $array)
	{
		$arr = array();
//		$obj = new \stdClass;
		
		foreach($array as $entity)
		{
			$reflector = new \ReflectionClass(get_class($entity));
			$props   = $reflector->getProperties();
			$obj = new \stdClass;
			
			foreach ($props as $property)
			{
				$property->setAccessible(true);
				$value = $property->getValue($entity);
				$name = $property->getName();
				$obj->$name = $value;
				$property->setAccessible(false);
			}
			$arr[] = $obj;
		}
		
		return $arr;
	}

}

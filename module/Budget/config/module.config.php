<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
		'routes' => array(
			'budget' => array(
				'type'    => 'segment',
				'options' => array(
					'route'    => '[/][budget][/:controller[/:action]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id'     => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Budget\Controller\Index',
						'action'     => 'index',
					),
				),
			),
		),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
		'invokables' => array(
			'budget.service.company' => 'Budget\Service\CompanyService',
			'budget.service.user' => 'Budget\Service\UserService',
			'budget.service.transactiontype' => 'Budget\Service\TransactiontypeService',
			'budget.service.transaction' => 'Budget\Service\TransactionService'
//			'doctrine.common.persistance.object_manager' => 'Doctrine\Common\Persistence\ObjectManager',
		),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Budget\Controller\Index' => 'Budget\Controller\IndexController',
            'Budget\Controller\Company' => 'Budget\Controller\CompanyController',
            'company' => 'Budget\Controller\CompanyController',
            'user' => 'Budget\Controller\UserController',
            'transactiontype' => 'Budget\Controller\TransactiontypeController',
            'transaction' => 'Budget\Controller\TransactionController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
		'strategies' => array(
			'ViewJsonStrategy',
		),
    ),
    'doctrine' => array(
		'connection' => array(
			// default connection name
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '3306',
					'user'     => 'budget',
					'password' => 'budget',
					'dbname'   => 'budget',
				)
			)
		),
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'budget_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Budget/Entity'
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Budget\Entity' => 'budget_annotation_driver'
                )
            )
        )
    ),
	
	'module_layouts' => array(
		'Budget' => 'layout/layout.phtml',
	)
);

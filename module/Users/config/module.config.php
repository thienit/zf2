<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
/*
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/users',
                    'defaults' => array(
                        'controller' => 'Users\Controller\users',
                        'action'     => 'index',
                    ),
                ),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[:action][/:id]',
							'constraints' => array(
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'id'     => '[0-9]+',
							),
							'defaults' => array(
							),
						),
					),
				),
            ),
        ),
    ),
 */
	'router' => array(
        'routes' => array(       
                    'users' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/users[/:action][/:id]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            	'id'     => '[0-9]*'
                            ),
                            'defaults' => array(
                            	'controller' => 'users\Controller\Users',
                            	'action'     => 'index',                            	
                            ),
                        ),
                    ),
                    ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\users' => 'Users\Controller\UsersController',
        ),
    ),
    'view_manager' => array(

        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);

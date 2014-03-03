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
            'news' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/news',
                    'defaults' => array(
                        'controller' => 'News\Controller\news',
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
                    'news' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/news[/:action][/:id]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            	'id'     => '[0-9]*'
                            ),
                            'defaults' => array(
                            	'controller' => 'news\Controller\News',
                            	'action'     => 'index',                            	
                            ),
                        ),
                    ),
                    ),
    ),
    'controllers' => array(
        'invokables' => array(
            'News\Controller\news' => 'News\Controller\NewsController',
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

<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
	'router' => array(
        'routes' => array(       
                    'contacts' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/contacts[/:action][/:id]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            	'id'     => '[0-9]*'
                            ),
                            'defaults' => array(
                            	'controller' => 'Contacts\Controller\Contacts',
                            	'action'     => 'index',                            	
                            ),
                        ),
                    ),
                    ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Contacts\Controller\Contacts' => 'Contacts\Controller\ContactsController',
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

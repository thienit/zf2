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
                    'cart' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/cart[/:action][/:id][/:sl][/:dg]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            	'id'     => '[0-9]*',
                            	'sl'	 => '[0-9]*',
                            	'dg'	 => '[0-9]*',
                            ),
                            'defaults' => array(
                            	'controller' => 'Cart\Controller\Cart',
                            	'action'     => 'index',                            	
                            ),
                        ),
                    ),
                    ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cart\Controller\Cart' => 'Cart\Controller\CartController',
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

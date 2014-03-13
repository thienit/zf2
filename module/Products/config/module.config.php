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
                    'product' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/sanpham[/:id].html',
                            'constraints' => array(
                                'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),

                    'product_groups' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/sanpham[/:id]',
                            'controller' 	=> 'ProductGroups\Controller\ProductGroups',
                            'action'		=> 'showProducts',
                                'id'     	=> '[0-9]*',
                            ),
                            'defaults' => array(
                                'controller' => 'ProductGroups\Controller\ProductGroups',
                                'action'     => 'index',                                
                            ),
                        ),

                    'manage-product' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/admin/sanpham[/:action][/:id]',
                            'constraints' => array(
                                'action'    => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'             => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),

                ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Products\Controller\Products' => 'Products\Controller\ProductsController',
            'ProductGroups\Controller\ProductGroups' => ' ProductGroups\Controller\ProductGroupsController',
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

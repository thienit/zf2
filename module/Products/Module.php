<?php 
namespace Products;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Products\Model\Products;
use Products\Model\ProductsTable;

class Module{
	
	public function getConfig(){
		return include __DIR__.'/config/module.config.php';
	}
	
	public  function getAutoloaderConfig()
	{
	    return array(
	    		'Zend\Loader\ClassMapAutoloader'=>array(__DIR__.'/autoload_classmap.php'),
	    		'Zend\Loader\StandardAutoloader'
	    		=>array('namespaces'=>array(__NAMESPACE__=>__DIR__.'/src/'.__NAMESPACE__),),
	    		);
	}
	
	public function getServiceConfig()
	{
		return array (
				'factories'	=> array(
						'Products\Model\ProductsTable' => function($sm) {
							$tableGateway = $sm->get('ProductsTableGageway');
							$table = new ProductsTable ($tableGateway);
							return $table;
						},
						'ProductsTableGageway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Products());
							return new TableGateway('product', $dbAdapter, null, $resultSetPrototype);
						}
				)
		);
	}
	
	
	
}
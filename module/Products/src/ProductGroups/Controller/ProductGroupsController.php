<?php
namespace ProductGroups\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProductGroupsController extends AbstractActionController
{
	protected $productGroupsTable;
	protected $productsTable;

	public function indexAction()
	{
		$productGroups = $this->getProductGroupsTable()->fetchAll();
		$products = $this-> getProductsTable()->fetchAll();
		return new ViewModel(array('productGroups'=>$productGroups,'products'=>$products));
	}

	public function getProductGroupsTable()
	{
		if(!$this->productGroupsTable){
			$sm = $this->getServiceLocator();
			$this->productGroupsTable = $sm->get('ProductGroups\Model\ProductGroupsTable');
		}
		return $this->productGroupsTable;
	}
	
	public function getProductsTable()
	{
		if(!$this->productsTable){
			$sm = $this->getServiceLocator();
			$this->productsTable = $sm->get('Products\Model\ProductsTable');
		}
		return $this->productsTable;
	}
}


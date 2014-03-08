<?php
namespace Products\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Products\Form\ProductsForm;

class ProductsController extends AbstractActionController
{
	protected $productsTable;
	public function indexAction()
	{
		$products = $this-> getProductsTable()->fetchAll();
		return new ViewModel(array('products'=>$products));
	}
	
	public function getProductsTable()
	{
		if(!$this->productsTable){
			$sm = $this->getServiceLocator();
			$this->productsTable = $sm->get('Products\Model\ProductsTable');
		}
		return $this->productsTable;
	}
	
	public function addAction()
	{
		$form = new ProductsForm();
		return new ViewModel(array('form'=>$form));
	}
	
	
	
}


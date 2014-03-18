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
	
	public function chitietAction()
	{
		$id = $this->params()->fromRoute('id');
		$product = $this->getProductsTable()->getProduct($id);
		return new ViewModel(array('product'=>$product));
	}
	
	public function addAction()
	{
		$form = new ProductsForm();
		$request = $this->getRequest();
		
		if($request->isPost())
		{
			$data = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
			
			$form->setData($data);
			if($form->isValid())
			{
				echo "du lieu hop cmn le";
			}
			else
			{
				echo "du lieu ko hop le";
			}
		}
		
		return new ViewModel(array('form'=>$form));
		
	}
	
	public function showProductsAction(){
		
		
	}
	
	
	
}


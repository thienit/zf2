<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Model\UsersTable;

class UsersController extends AbstractActionController
{
	public function indexAction(){
		$userstable = new UsersTable();
		$users = $userstable->fetchAll();
		return new ViewModel(array('users'=>$users));
	}
	
	public function detailAction(){
		$key = $this->params()->fromRoute('id');
		$userstable = new UsersTable();
		$user = $userstable->getUser($key);
		return new ViewModel(array('user'=>$user));
	}
	
	public function addAction(){
		$request = $this->getRequest();
		if($request->isPost()){
			$data = $request->getPost();
			
			$userstable = new UsersTable();
			if($userstable->addUser($data)){
				echo "Add user successfull!";
			}
			
		}
		return new ViewModel();
	}
}


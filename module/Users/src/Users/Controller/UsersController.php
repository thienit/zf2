<?php
namespace Users\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Model\UsersTable;
use Users\Form\LoginForm;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
class UsersController extends AbstractActionController
{
	public function indexAction(){
		$auth = new AuthenticationService();
		if(!$auth->hasIdentity())
		{
			return $this->redirect()->toRoute('users',array('action'=>'login'));
		}
		else
		{
			$name  = $auth->getIdentity();
		}
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
	
	public function loginAction()
	{
		$form = new LoginForm($this->getRequest()->getBaseUrl().'/public/images/captcha');
		$request = $this->getRequest();
		if($request->isPost())
		{
			$form->setData($request->getPost());
			if($form->isValid())
			{
				$post = $request->getPost();
				$sm = $this->getServiceLocator();
				$dbAdapter = $sm->get('Zend\Db\Apdater\Adapter');
				
				$authAdapter = new AuthAdapter($dbAdapter,'user','username','password');
				
				$authAdapter->setIdentity($post->get('username'))->setCredential($post->get('password'));
				
				$authService = new AuthenticationService();
				$authService->setAdapter($authAdapter);
				
				$result = $authService->authenticate();
				
				if($result->isValid())
				{
					$storage = $authService->getStorage();
					$storage->write($authAdapter->getResultRowObject(array('username','fulname'.'role')));
					return $this->redirect()->toRoute('user');
				}
			}
		}
		return new ViewModel(array('form'=>$form));
	}
	
	public function generateAction()
	{
		$response = $this->getResponse();
		$response->getHeaders()->addHeaderLine('Content-Type', "image/png");
	
		$id = $this->params('id', false);
	
		if ($id) {
			 
			$image = './public/images/captcha' . $id;
	
			if (file_exists($image) !== false) {
				$fp  = fopen($image,"r");
				$imageread = fpassthru($fp);
	
				$response->setStatusCode(200);
				$response->setContent($imageread);
				 
				if (file_exists($image) == true) {
					unlink($image);
				}
			}
		}
		return $response;
	}
}


<?php
namespace Contacts\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contacts\Model\ContactsTable;
use Contacts\Form\ContactsForm;
use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;


class ContactsController extends AbstractActionController
{
	public function indexAction()
	{
		$form = new ContactsForm($this->getRequest()->getBaseUrl().'./public/images/captcha');
		$request = $this->getRequest();
		if($request->isPost())
		{
			$data = array_merge_recursive($request->getPost()->toArray(),$request->getFile()->toArray());
			$form->setData($data);
			if($form->isValid())
			{
				$this->sendcontact($data);
			}
		}
		
		return new ViewModel(array('form'=>$form));
	}
	
	public function sendcontact($data)
	{
		$form = new ContactsForm();
		
		
		//$text = new MimePart($data['content']);
		$text = new MimePart("Mail mail");
		$text->type = "text/plain";
		$html = new MimePart("<i>Hom nay hoc gui mail</i>");
		$html->type = "text/html";
		$image = new MimePart(fopen("public/images/lienhe/1.jpg",'r'));
		$image->type = "image/jpg";
		$image->encoding = "base64";
		$body = new MimeMessage();
		$body->setParts(array($text,$image,$html));
		
		$msg = new Message();
		$msg->setEncoding("UTF-8");
		$msg->setBody($body);
		$msg->setFrom("thienitplus@gmail.com","Thien Nguyen");
		$msg->setSubject('Test mail SMTP');
		$msg->addTo("thienitplus@gmail.com","Hoang");
		
		$smtpOps = new \Zend\Mail\Transport\SmtpOptions();
		$smtpOps->setHost('smtp.gmail.com')->setConnectionClass('login')
													->setName('smtp.gmail.com')
														->setConnectionConfig(array(
																'username'	=> 'thienitplus@gmail.com',
																'password'	=> '1110117C6',
																'ssl'		=> 'tls'
																));
		$transport = new \Zend\Mail\Transport\Smtp($smtpOps);
		try {
			$transport->send($msg);
			echo "Goi mail thanh cong";
			exit();
		}
		catch (Exception $e)
		{
			echo 'Goi mail khong thanh cong';
			exit();
		}
		return new ViewModel(array('form'=>$form));
	}
// 	public function detailAction(){
// 		$key = $this->params()->fromRoute('id');
// 		$userstable = new UsersTable();
// 		$user = $userstable->getUser($key);
// 		return new ViewModel(array('user'=>$user));
// 	}
	
// 	public function addAction(){
// 		$request = $this->getRequest();
// 		if($request->isPost()){
// 			$data = $request->getPost();
			
// 			$userstable = new UsersTable();
// 			if($userstable->addUser($data)){
// 				echo "Add user successfull!";
// 			}
			
// 		}
// 		return new ViewModel();
// 	}
	
// 	public function loginAction()
// 	{
// 		$form = new LoginForm($this->getRequest()->getBaseUrl().'/public/images/captcha');
// 		$request = $this->getRequest();
// 		if($request->isPost())
// 		{
// 			$form->setData($request->getPost());
// 			if($form->isValid())
// 			{
// 				$post = $request->getPost();
// 				$sm = $this->getServiceLocator();
// 				$dbAdapter = $sm->get('Zend\Db\Apdater\Adapter');
				
// 				$authAdapter = new AuthAdapter($dbAdapter,'user','username','password');
				
// 				$authAdapter->setIdentity($post->get('username'))->setCredential($post->get('password'));
				
// 				$authService = new AuthenticationService();
// 				$authService->setAdapter($authAdapter);
				
// 				$result = $authService->authenticate();
				
// 				if($result->isValid())
// 				{
// 					$storage = $authService->getStorage();
// 					$storage->write($authAdapter->getResultRowObject(array('username','fulname'.'role')));
// 					return $this->redirect()->toRoute('user');
// 				}
// 			}
// 		}
// 		return new ViewModel(array('form'=>$form));
// 	}
	
// 	public function generateAction()
// 	{
// 		$response = $this->getResponse();
// 		$response->getHeaders()->addHeaderLine('Content-Type', "image/png");
	
// 		$id = $this->params('id', false);
	
// 		if ($id) {
			 
// 			$image = './public/images/captcha' . $id;
	
// 			if (file_exists($image) !== false) {
// 				$fp  = fopen($image,"r");
// 				$imageread = fpassthru($fp);
	
// 				$response->setStatusCode(200);
// 				$response->setContent($imageread);
				 
// 				if (file_exists($image) == true) {
// 					unlink($image);
// 				}
// 			}
// 		}
// 		return $response;
// 	}
}


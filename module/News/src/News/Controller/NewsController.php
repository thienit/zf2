<?php
namespace News\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use News\Model\NewsTable;

class NewsController extends AbstractActionController
{
	public function indexAction()
	{
		$newstable = new NewsTable();
		$news = $newstable->fetchAll();
		return new ViewModel(array('news'=>$news));
	}
	
	public function detailAction() 
	{
		$key = $this->params()->fromRoute('id');
		if(empty($key)) {
			$this->redirect()->toRoute('news');
		}
		$newstable = new NewsTable();
		$post = $newstable->getNews($key);
		if(empty($post)) {
			$this->redirect()->toRoute('news');
		}
		return new ViewModel(array('post'=>$post));
	}
	
	public function addAction()
	{
		$request = $this->getRequest();
		if($request->isPost()){
			$data = $request->getPost();
			if(isset($data['cancel']))
			{
				$this->redirect()->toRoute('news');
			}
			elseif(isset($data['submit']))
			{
				$files = $request->getFiles('images');
				move_uploaded_file($files['tmp_name'],'./public/img/'.$files['name']);
				$param = array(
						'title'				=> $data['title'],
						'content_summary'	=> $data['content_summary'],
						'content_detail'	=> $data['content_detail'],
						'images'			=> $files['name']
						);
				$newstable = new NewsTable();
				$generatedValue = $newstable->addNews($param);
				if($generatedValue){
					$this->redirect()->toRoute('news',array('action'=>'edit','id'=>$generatedValue));
				}
			}
			
		}
		return new ViewModel();
	}
	
	public function editAction()
	{
		$key = $this->params()->fromRoute('id');
		if(empty($key))
		{
			$this->redirect()->toRoute('news');	
		}
		else {
			// get post base on $key
			$newstable = new NewsTable();
			$post = $newstable->getNews($key);
			
			$request = $this->getRequest();
			if($request->isPost()){
				$data = $request->getPost();
				if(isset($data['cancel']))
				{
					$this->redirect()->toRoute('news');
				}
				elseif(isset($data['submit']))
				{
					$files = $request->getFiles('images');
					move_uploaded_file($files['tmp_name'],'./public/img/'.$files['name']);
					//delete old image
					//unlink('./public/img/'.$post['name']);
					$param = array(
							'news_id'			=> $key,
							'title'				=> $data['title'],
							'content_summary'	=> $data['content_summary'],
							'content_detail'	=> $data['content_detail'],
							'images'			=> $files['name']
							);
					$newstable = new NewsTable();
					if($newstable->updateNews($param)){
						$this->redirect()->toRoute('news',array('action'=>'edit','id'=>$key));
					}
				}
			}
			else {
				
				
				if(empty($post)){
					$this->redirect()->toRoute('news');
				}
			}
		}
		return new ViewModel(array('post'=>$post));
	}
	
	public function deleteAction()
	{
		$key = $this->params()->fromRoute('id');
		if(empty($key))
		{
			$this->redirect()->toRoute('news');	
		}
		else
		{
			$newstable = new NewsTable();
			$newstable->deleteNews($key);
			
		}
		$this->redirect()->toRoute('news');
	}
}


<?php
namespace News\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
class NewsTable
{
	
	protected $connect;
	public function __construct()
	{
		$this->connect = array(
					'driver' => 'Mysqli',
					'database' => 'fashion',
					'username' => 'root',
					'password' => '',
					'charset' => 'utf8',
				);
	}
	
	public function fetchAll()
	{
		$adapter = new Adapter($this->connect);
		$sql = new Sql($adapter);
		$select = $sql->select('news');
		$select->columns(array('news_id','title','content_summary','date_send','date_post','views','images','author'));
		$select->order("date_post DESC");
		$statement = $sql->prepareStatementForSqlObject($select);
		$result =  $statement->execute();
		return $result;
	}
	
	public function getNews($id)
	{
		$adapter = new Adapter($this->connect);
		$sql = new Sql($adapter);
		$select = $sql->select('news');
		$select->where(array('news_id'=>$id));
		$statement = $sql->prepareStatementForSqlObject($select);
		$result =  $statement->execute();
		return $result->current();
	}
	
	public function addNews($param)
	{
		
		$adapter = new Adapter($this->connect);
		$sql = new Sql($adapter);
		$insert = $sql->insert('news');
		$insert->values(array(
				'title' 			=> $param['title'],
				'content_summary'	=> $param['content_summary'],
				'content_detail'	=> $param['content_detail'],
				'images'			=> $param['images']
				));
		$statement = $sql->prepareStatementForSqlObject($insert);
		$result = $statement->execute();
		$result->getGeneratedValue();
		return $result->getGeneratedValue();;
	}
	
	public function updateNews($param)
	{
		$adapter = new Adapter($this->connect);
		$sql = new Sql($adapter);
		$update = $sql->update('news');
		if($param['images']=='')
		{
			$update->set(array(
					'title' 			=> $param['title'],
					'content_summary'	=> $param['content_summary'],
					'content_detail'	=> $param['content_detail'],
					));
		}
		else
		{
			$update->set(array(
					'title' 			=> $param['title'],
					'content_summary'	=> $param['content_summary'],
					'content_detail'	=> $param['content_detail'],
					'images'			=> $param['images']
					));
		}
		$update->where(array('news_id'=>$param['news_id']));
		$statement = $sql->prepareStatementForSqlObject($update);
		$result = $statement->execute();
		return $result->getAffectedRows();
	}
	
	public function deleteNews($id){
		$adapter = new Adapter($this->connect);
		$sql = new Sql($adapter);
		$delete = $sql->delete('news');
		$delete->where(array('news_id'=>$id));
		$statement = $sql->prepareStatementForSqlObject($delete);
		$result = $statement->execute();
		return $result->getAffectedRows();
	}
	
}
<?php
namespace Users\Model;
use Zend\Db\Adapter\Adapter;
class UsersTable
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
		$result = $adapter->query("SELECT * FROM user", $adapter::QUERY_MODE_EXECUTE);
		return $result;
	}
	
	public function getUser($id)
	{
		$adapter = new Adapter($this->connect);
		$statement = $adapter->createStatement("SELECT * FROM user WHERE id=?",array($id));
		$result =  $statement->execute();
		return $result->current();
	}
	
	public function addUser($param){
		$adapter = new Adapter($this->connect);
		$result = $adapter->query("INSERT INTO user(username,password,email) VALUES(?,?,?)", 
				array($param['username'],$param['password'],$param['email']));
		return $result;
	}
	
}
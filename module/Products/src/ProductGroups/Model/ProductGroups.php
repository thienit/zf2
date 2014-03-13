<?php
namespace ProductGroups\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
class ProductGroups
{
	public $group_id;
	public $group_name;
	public $group_id_parent;
	
	public function exchangeArray($data) 
	{
		$this->group_id = (!empty($data['group_id'])) ? $data['group_id'] : null;
		$this->group_name = (!empty($data['group_name'])) ? $data['group_name'] : null;
		$this->group_id_parent = (!empty($data['group_id_parent'])) ? $data['group_id_parent'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
}
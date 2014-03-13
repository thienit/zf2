<?php
namespace ProductGroups\Model;
use Zend\Db\TableGateway\TableGateway;
class ProductGroupsTable extends TableGateway
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
	
	public function getProductGroups($id)
	{
		$id = (int) id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) 
		{
			throw new \Exception("Could not find now $id");
		}
		return $row;
	}
}












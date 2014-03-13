<?php
namespace ProductGroups\Model;
use Zend\Db\TableGateway\TableGateway;
use Products\Model\ProductsTable;
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
	
	public function getProducts($groupId)
	{
		return getProductsWithGroup($groupId);
	}
}












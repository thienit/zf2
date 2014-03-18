<?php
namespace Products\Model;
use Zend\Db\TableGateway\TableGateway;
class ProductsTable extends TableGateway
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
	
	public function getProduct($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) 
		{
			throw new \Exception("Could not find now $id");
		}
		return $row;
	}
	
	public function getProductsWithGroup($groupId)
	{
		$resultSet = $this->tableGateway->select(array('group_id' =>$groupId));
		return $resultSet;
	}
	
	public function saveProduct(Products $product)
	{
		$data = array(
			 'product_id' 		=> $product->product_id,
			 'product_name'		=> $product->product_name,
			 'alias'			=> $product->alias,
			 'price'			=> $product->price,
			 'info'				=> $product->info,
			 'image'			=> $product->image,
			 'status'			=> $product->status,
			 'category_id'		=> $product->category_id,
			 'group_id'			=> $product->group_id,
			 'subject_id'		=> $product->subject_id,
			 'sales'			=> $product->sales,
			 'likes'			=> $product->likes,
			 'date_updated'		=> $product->date_updated,
			 'dele'				=> $product->dele,
			);
	}
}












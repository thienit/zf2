<?php
namespace Products\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
class Products
{
	public $id;
	public $product_id;
	public $product_name;
	public $alias;
	public $price;
	public $info;
	public $image;
	public $status;
	public $category_id;
	public $group_id;
	public $subject_id;
	public $sales;
	public $likes;
	public $date_updated;
	public $dele;
	
	public function exchangeArray($data) 
	{
		$this->id = (!empty($data['id'])) ? $data['id'] : null;
		$this->product_id = (!empty($data['product_id'])) ? $data['product_id'] : null;
		$this->product_name = (!empty($data['product_name'])) ? $data['product_name'] : null;
		$this->alias = (!empty($data['alias'])) ? $data['alias'] : null;
		$this->price = (!empty($data['price'])) ? $data['price'] : null;
		$this->info = (!empty($data['info'])) ? $data['info'] : null;
		$this->image = (!empty($data['image'])) ? $data['image'] : null;
		$this->status = (!empty($data['status'])) ? $data['status'] : null;
		$this->category_id = (!empty($data['category_id'])) ? $data['category_id'] : null;
		$this->group_id = (!empty($data['group_id'])) ? $data['group_id'] : null;
		$this->subject_id = (!empty($data['subject_id'])) ? $data['subject_id'] : null;
		$this->sales = (!empty($data['sales'])) ? $data['sales'] : null;
		$this->likes = (!empty($data['likes'])) ? $data['likes'] : null;
		$this->date_updated = (!empty($data['date_updated'])) ? $data['date_updated'] : null;
		$this->dele = (!empty($data['dele'])) ? $data['dele'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
}
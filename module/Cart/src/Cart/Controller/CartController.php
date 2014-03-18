<?php
namespace Cart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;

class CartController extends AbstractActionController
{
	public function insertAction()
	{
		$id = $this->params()->fromRoute('id');
		$sl = $this->params()->fromRoute('sl');
		$dg = $this->params()->fromRoute('dg');
		
		$config = new StandardConfig();
		$config->setRememberMeSeconds(1800);
		$config->setName('cartzf2');
		$manager = new SessionManager($config);
		
		$cart = new Container('cart');
		if($cart->offsetExists('sanpham'))
		{
			if(isset($cart->sanpham[$id]))
			{
				$cart->tongtien -= $cart->sanpham[$id]*$dg;
				$cart->soluong -= $cart->sanpham[$id];
			}
			$cart->sanpham[$id] = $sl;
			$cart->tongtien += $sl*$dg;
			$cart->soluong += $sl;
		}
		else
		{
			$cart->sanpham = array($id=>$sl);
			$cart->tongtien = $sl*dg;
			$cart->soluong = $sl;
		}
		
		$array = array('sl'=>$cart->soluong, 'tt'=>$cart->tongtien);
		echo json_encode($array);
		exit();
	}
	
	public function tongtien()
	{
		$cart = new Container('cart');
		if($cart->offsetExists('sanpham'))
			return $cart->tongtien;
		return 0;
	}
	
	public function soluong()
	{
		$cart = new Container('cart');
		if($cart->offsetExists('sanpham'))
			return $cart->soluong;
		return 0;
	}
	
	public function update($id, $soluong, $dongia)
	{
		$cart = new Container('cart');
		if(isset($cart->sanpham[$id]))
		{
			if($cart->sanpham[$id] != $soluong)
			{
				$cart->tongtien -= $giohang->sanpham[$id]*$dongia;
				$cart->soluong -= $giohang->sanpham[$id];
				$cart->sanpham[$id] = $soluong;
				$cart->tongtien += $soluong*$dongia;
				$cart->soluong += $soluong;
			}
		}
	}
	
	public function cartAll()
	{
		$cart = new Container('cart');
		if($cart->offsetExists('sanpham'))
			return $cart->sanpham;
		return array();
	}
	
	public function deleteSanpham($id, $dongia)
	{
		$cart = new Container('cart');
		$cart->tongtien -= $cart->sanpham[$id]*$dongia;
		$cart->soluong -= $cart->sanpham[$id];
		$cart_new = array();
		foreach($cart->sanpham as $key=>$value)
		{
			if($key != $id)
			{
				$cart_new[$key] = $value;
			}
		}
		
		if($cart_new)
			$cart->sanpham = $cart_new;
		else
			$cart->getManager()->getStorage()->clear();
		return false;
	}
	
	public function clearAction()
	{
		$cart = new Container('cart');
		if($cart->offsetExists('sanpham'))
		{
			$cart->getManager()->getStorage()->clear();
		}
	}
	
}















<?php
namespace Products\Form;
use Zend\Form\Form;
use Zend\Form\Element;


class ProductsForm extends Form
{
	public function __construct($name=null)
	{
		parent::__construct();
		$this->setAttribute('method', 'post');
		// init form element
		$this->addElement();
		$this->addInputFilter();
	}	
	
	public function addElement()
	{
		$product_name = new Element\Text('product_name');
		$product_name->setLabel('Name');
		$this->add($product_name);
		
		
		$alias = new Element\Text('alias');
		$alias->setLabel('Alias');
		$this->add($alias);
		
		$email = new Element\Text('email');
		$email->setLabel('Email');
		$this->add($email);
		
		$submit = new Element\Submit('submit');
		$submit->setValue('Submit');
		$this->add($submit);
	}
	
	public function addInputFilter()
	{
		$email = new Input('email');
		$email->getValidatorChain()->addByName('NotEmpty',array('message'=>array('isEmpty'=>'Phai nhap du lieu')))
									->addByName('EmailAddress',array('message'=>array('emailAddressInvalidFormat'=>'Phai nhap dung dia chi email')));
		$password = new Input('password');
		$password->getValidatorChain()
					->addByName('NotEmpty',array('message'=>array('isEmpty'=>'Phai nhap du lieu')))
						->addByName('StringLength',array('min'=>8,'max'=>50,'message'=>array(
								'stringLengthTooShort'=>'Phai nhap it nhat 8 ky tu',
								'stringLengthTooLong'=>'Chi nhap toi da 50 ky tu')));
		$inputFilter = new InputFilter();
		
		$inputFilter->add($email);
		$inputFilter->add($password);
		
		$this->setInputFilter($inputFilter);
		
	}
}
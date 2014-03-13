<?php
namespace Products\Form;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;

class ProductsForm extends Form
{
	public function __construct($name=null)
	{
		parent::__construct();
		$this->setAttribute('method', 'post');
		// init form element
		$this->addElement();
		//$this->addInputFilter();
	}	
	
	public function addElement()
	{
		$product_name = new Element\Text('product_name');
		$product_name->setLabel('Name:');
		$this->add($product_name);
		
		$alias = new Element\Text('alias');
		$alias->setLabel('Alias:');
		$this->add($alias);
		
		$info = new Element\TextArea('info');
		$info->setLabel('Info:');
		$info->setAttribute('id','editor1');
		$this->add($info);
		
		$price = new Element\Text('price');
		$price->setLabel('Price:');
		$this->add($price);
		
		$image = new Element\File('image');
		$image->setLabel('Featured images:');
		$image->setAttribute('id', 'featured_image');
		$this->add($image);
		
		$submit = new Element\Submit('submit');
		$submit->setValue('Submit');
		$this->add($submit);
		
		$cancel = new Element\Submit('cancel');
		$cancel->setValue('Cancel');
		$this->add($cancel);
	}
	
	public function addInputFilter()
	{
		$email = new Input('email');
		$email->getValidatorChain()->addByName('NotEmpty',array('message'=>array('isEmpty'=>'Phai nhap du lieu')))
									->addByName('EmailAddress',array('message'=>array('emailAddressInvalidFormat'=>'Phai nhap dung dia chi email')));
		//$password = new Input('password');
		//$password->getValidatorChain()
		//			->addByName('NotEmpty',array('message'=>array('isEmpty'=>'Phai nhap du lieu')))
		//				->addByName('StringLength',array('min'=>8,'max'=>50,'message'=>array(
		//						'stringLengthTooShort'=>'Phai nhap it nhat 8 ky tu',
		//						'stringLengthTooLong'=>'Chi nhap toi da 50 ky tu')));
		
		$inputFilter = new InputFilter();
		$inputFilter->add($email);
		
		$file = new Input('file');
		$file->setRequired(false);
		$file->getValidatorChain()->addByName('fileextension',array('extension'=>'jpeg,png,jpg,bmp'))
									->addByName('filesize',array('max'=>2048000));
		
		$file->getFilterChain()->attachByName('filerenameupload',array('target'=>'./public/temp/','randomize'=>true,'UseUploadName'=>true));
		$inputFilter->add($file);
		
		$this->setInputFilter($inputFilter);
		
	}
}
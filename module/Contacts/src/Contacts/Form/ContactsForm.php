<?php 
namespace Contacts\Form;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Element\Captcha;
use Zend\Captcha\Image as CaptchaImage;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator;

class ContactsForm extends Form
{
	public function __construct($name=null)
	{
		parent::__construct('login');
		$this->setAttribute('method','post');
		$this->setAttributes(array('method'=>'post', 'multipart/form-data'=>'multipart/form-data'));
		//create captcha
		$dirdata = './public/images';
		$captchaImage = new CaptchaImage(
				array(
						'font'			=> $dirdata.'/fonts/arial.ttf',
						'width'			=> 150,
						'height'		=> 50,
						'expiration'	=> 300,
						'dotNoiseLevel'	=> 50,
						'lineNoiseLevel'=> 5,
						'GcFreq'		=> 5
					)
		);
		
		$captchaImage->setImgDir($dirdata.'/captcha');
		$captchaImage->setImgUrl($name);
		
		$this->add(
				array(
						'type'			=> 'Zend\Form\Element\Captcha',
						'name'			=> 'captcha',
						'options'		=> array('label' => 'Enter the characters you see', 'captcha' => $captchaImage),
				)
		);
		$this->addElement();
		$this->addInputFilter();
	}
	
	public function  addElement()
	{
		$name = new Element\Text('name');
		$name->setLabel('Name');
		$this->add($name);
		
		$email = new Element\Text('email');
		$email->setLabel('Email');
		$this->add($email);
		
		$content = new Element\Textarea('content');
		$content->setLabel('Content');
		$this->add($content);
		
		$file = new Element\File('attachment');
		$file->setLabel('Attachment');
		$this->add($file);
		
		$submit = new Element\Submit('submit');
		$submit->setValue('Send');
		$submit->setAttributes(array('class'=>'art-button'));
		$this->add($submit);
	}
	
	public function addInputFilter()
	{
		$inputFilter = new InputFilter();
		
		$name = new Input('name');
		$name->getValidatorChain()->addByName('NotEmpty');
		$inputFilter->add($name);
		
		$email = new Input('email');
		$email->getValidatorChain()->addByName('NotEmpty')
									->addByName('EmailAddress');
		$inputFilter->add($email);
		$this->setInputFilter($inputFilter);
		
	}
}
<?php 
namespace Users\Form;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Element\Captcha;
use Zend\Captcha\Image as CaptchaImage;

class LoginForm extends Form
{
	public function __construct($name=null)
	{
		parent::__construct('login');
		$this->setAttribute('method','post');
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
						'options'		=> array('label' => 'Mã xác thực', 'captcha' => $captchaImage),
						'attributes'	=> array('style' => 'width:80%')
				)
		);
		$this->addElement();
	}
	
	public function  addElement()
	{
		$username = new Element\Text('username');
		$username->setLabel('Username');
		$username->setAttributes(array('style'=>'width:80%'));
		$this->add($username);
		
		$password = new Element\Password('password');
		$password->setLabel('Password');
		$password->setAttributes(array('style'=>'width:80%'));
		$this->add($password);
		
		$submit = new Element\Submit('submit');
		$submit->setValue('Login');
		$submit->setAttributes(array('class'=>'art-button'));
		$this->add($submit);
	}
}
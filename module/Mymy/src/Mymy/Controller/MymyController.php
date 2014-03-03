<?php
namespace Mymy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MymyController extends AbstractActionController
{
	public function indexAction() {
		$a = "rù rù rù meo";
		$b = "meo meo rù rù";
		return new ViewModel(array('a'=>$a,'b'=>$b));
	}
	
	
}
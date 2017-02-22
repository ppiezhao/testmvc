<?php
/**
*\HomeController
*/
class IndexController extends Mmvc_Controller_Abstract
{
	public function indexaction()
	{
		
		echo "<h1>控制器成功！</h1>";
		$class = new RoleModel();
		echo "<br/>";
		echo $class->getRoleInfo();
		
		$aaa = "aaa";
		$this->getView()->assign("aaa",$aaa);
	}	
}


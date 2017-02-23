<?php
/**
*\HomeController
*/
class IndexController extends Mmvc_Controller_Abstract
{
	public function indexaction()
	{
		
		$request = $this->getRequest()->get("aaa","");
		print_r($request);
		echo "<h1>控制器成功！</h1>";
		
		echo "<br/>";
		$class = new RoleModel();
		$aaa = "aaa";
		echo $aaa;
		echo "<br/>";
		print_r($request);
		echo $class->getRoleInfo();
		
		$aaa = array("http"=>"www.aaa.com","com"=>"aaaaa");
		echo "aaa";
		//return false;
		$this->getView()->assign("aaa",$aaa);
	}
	public function homeaction()
	{
		$request = $this->getRequest()->getRequest("app_id",0);
		$data['error'] =0;
		$data['errmsg'] = $request;
		echo json_encode($data);
		return false;
	}
}


<?php
/**
 * Mmvc Application
 */
class Mmvc_Application
{
	public static $_view;
	public function __construct()
	{
	
	}
	public static function dispatch()
	{
		//获取model，controller
		$controllerResult = self::GetHttp();
		$view = self::initView();
		$controllerName = self::GetControllerName($controllerResult);
		$controller = new $controllerName($view);
		$actionName = $controllerResult['action']."Action";
		$controller->$actionName();
		$controller->render($controllerResult['action'].".php");
	}

	//
	protected static function GetHttp()
	{
		$conFile = Mmvc_G::get('default_controller_dirctory');
		$conName = Mmvc_G::get('default_controller_name');
		$url = $_SERVER['REQUEST_URI'];
		$urlResult = array(
						'moduel' => 'app',
						'controller' => 'Index',
						'action' => 'index'	
					 );
		if($url != '/'){
			$urlMid = explode('/',$url);
			$controllerFile = APPLICATION_PATH . strtolower($urlMid[1]).'/'.$conFile.'/'.ucfirst($urlMid[2]).$conName; 
			if (file_exists($controllerFile)) {
				
				$urlResult['module'] = strtolower($urlMid[1]);  
				$urlResult['controller'] = ucfirst($urlMid[2]) ? ucfirst($urlMid[2]) : "Index";
				$urlResult['action'] = $urlMid[3] ? $urlMid[3] : "index";
				$urlResult['query'] = array();
				foreach($urlMid as $key=>$mid){
					if($key <=3 || $key%2 == 0){
						$keyValue = $mid;
						continue;
					}
					$urlResult["$keyValue"] = $mid;
				}
			}else{
				$controllerFile = APPLICATION_PATH.'/'.$urlResult['moduel'].'/'.$conFile.'/'.ucfirst($urlMid[1]).$conName; 
				if (file_exists($controllerFile)) {  
					$urlResult['controller'] = ucfirst($urlMid[1]);
					$urlResult['action'] = $urlMid[2] ? $urlMid[2] : "index";
					foreach($urlMid as $key=>$mid){
						if($key <=2 || $key%2 != 0){
							$keyValue = $mid;
							continue;
						}
						$urlResult['query']["$keyValue"] = $mid;
					}
				} else {
					die("controller is not exit");
				} 
			}
		}
		Mmvc_G::set('module_dirctory',$urlResult['moduel']);
		return $urlResult;
	}	

	//获取controllerName
	protected static function GetControllerName($array){
		$controllerDir = APPLICATION_PATH."/".$array['moduel']."/controllers/";
		$controller = $array['controller'];
		$className = $controller."Controller";
		if(!class_exists($className, false)) {
			if(!Mmvc_Loader::getInstance()->internal_autoload($controller, $controllerDir)) {
				die();
			}
		}
		return $className;
	}
	
	//视图相关
	public static function initView($templates_dir=null, $options=array())
	{
		if (self::$_view == null) {
			self::$_view = new Mmvc_View_Simple($templates_dir, $options);
		}
		return self::$_view;
	}
}

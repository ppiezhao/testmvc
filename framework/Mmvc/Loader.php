<?php
/**
 * Mmvc loader
 */
class Mmvc_Loader
{
	const YAF_LOADER_MODEL = 'Model';
	protected static $_instance;
	public static function internal_autoload($class, $dirs = null)
	{
		if (class_exists($class, false) || interface_exists($class, false)) {
			return;
		}
		$file = $class.".php";
		if (!empty($dirs)) {
			$dirPath = dirname($file);
			$dirs = explode(":", $dirs);
			foreach ($dirs as $key => $dir) {
				$dir = rtrim($dir, '\\/');
                $dirs[$key] = $dir . DIRECTORY_SEPARATOR . $dirPath;
			}
			$file = basename($file);
			return self::import($file, $dirs);
		} else {
			$dirPath = dirname(APPLICATION_PATH . $class);
			$dirs = explode(":", $dirPath);
			$dirPath = ".";
			foreach ($dirs as $key => $dir) {
				$dir = rtrim($dir, '\\/');
                $dirs[$key] = $dir . DIRECTORY_SEPARATOR . $dirPath;
			}
			$class = basename($class);
			self::import($class, $dirs);
		} 
	}

	public static function import($filename, $dirs = null)
	{
		
		$incPath = false;
		if (!empty($dirs) && (is_array($dirs) || is_string($dirs))) {
			if (is_array($dirs)) {
				$dirs = implode(':',$dirs);
			}
			$incPath = get_include_path();
			set_include_path($dirs . ":" . $incPath);
			if (!include $filename) {
				return false;
			}	
			if ($incPath) {
				set_include_path($incPath);
			}
			
			return true;
		}
	}
		
	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
			$instance = self::$_instance;
			if (phpversion() >= "5.3") {
				spl_autoload_register(
					array($instance, 'autoload'), true, false
				);
			} else {
				spl_autoload_register(
					array($instance, 'autoload'), true
				);
			}
		} 

		return self::$_instance;	
	}
	
	public function autoload($class)
	{
		if ($this->isCategoryType($class, self::YAF_LOADER_MODEL)) {
            //this is a model
            $directory = APPLICATION_PATH .
				DIRECTORY_SEPARATOR .
				Mmvc_G::get('module_dirctory').
                DIRECTORY_SEPARATOR.
				Mmvc_G::get('models_dirctory').
                DIRECTORY_SEPARATOR;
			$class = $this->resolveCategory(
                $class, self::YAF_LOADER_MODEL
            );
		}
		$this->internal_autoload($class, $directory);
	}
	
	public function resolveCategory($className, $category)
    {
        return substr(
                $className,
                0,
                strlen($category)-1
            );
        
    }
	
	public function isCategoryType($className, $category)
    {
        if($category == substr($className, strlen($className)-strlen($category), strlen($category))){
					return true;
		}
		return false;
    }
}

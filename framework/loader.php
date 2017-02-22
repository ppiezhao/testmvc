<?php
function mmvc_auto_load($classname)
{
	$path = str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';	
		if (file_exists(APPLICATION_PATH. '/framework/' . $path)) {
			require_once(APPLICATION_PATH. '/framework/' . $path);
		}
}
spl_autoload_register('mmvc_auto_load');


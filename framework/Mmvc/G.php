<?php
/**
 * added this class to handle all the global options
 * which are available when yaf.so is loaded
 *
 */
class Mmvc_G
{
    protected static $_globals = array(
        'directory' => null,
        'module_dirctory' => "app",
        'controller_dirctory' => "controllers",
        'controller_name' => "controller.php",
		'models_dirctory' => "models",
		'view_dirctory' => "views"
    );
    

    public static function set($key, $value)
    {
        self::$_globals[$key] = $value;
    }

    public static function get($key)
    {
        if (isset(self::$_globals[$key])) {
            return self::$_globals[$key];
        }
        return null;
    }


    public static function isAbsolutePath($path)
    {
        if (
            substr($path, 0, 1) == "/"
            ||
            (
                (strpos($path, ":") !== false)
                &&
                (strpos(PHP_OS, "WIN") !== FALSE)
            )
        ) {
            return true;
        } else {
            return false;
        }
    }
}
<?php
/**
 * Mmvc Request Http
 */
class Mmvc_Request_Http
{
    public $_params = array();
    public function __construct()
    {
        
    }

    
    public function get($name, $default=null)
    {
		switch (true) {
            case isset($this->_params[$name]):
                return $this->_params[$name];
            case isset($_GET[$name]):
                return $_GET[$name];
            case isset($_POST[$name]):
                return $_POST[$name];
            case isset($_COOKIE[$name]):
                return $_COOKIE[$name];
            case ($name == 'REQUEST_URI'):
                return $this->getRequestUri();
            case ($name == 'PATH_INFO'):
                return $this->getPathInfo();
            case isset($_SERVER[$name]):
                return $_SERVER[$name];
            case isset($_ENV[$name]):
                return $_ENV[$name];
            default:
                return $default;
        }
    }
	
	public function getRequest($name = null, $default = null)
    {
        if (null === $name) {
            return $_REQUEST;
        }
        return (isset($_REQUEST[$name])) ? $_REQUEST[$name] : $default;
    }
	
	public function getPost($name = null, $default = null)
    {
        if (null === $name) {
            return $_POST;
        }
        return (isset($_POST[$name])) ? $_POST[$name] : $default;
    }
	
	public function setParam($name, $value=null)
    {
		if (is_array($name)) {
            $this->_params = $this->_params + (array) $name;

           /*  foreach ($name as $key => $value) {
                if (null === $value) {
                    unset($this->_params[$key]);
                }
            } */
        } else {
            $name = (string) $name;

            /*if ((null === $value) && isset($this->_params[$name])) {
                unset($this->_params[$name]);
            } elseif (null !== $value) {
                $this->_params[$name] = $value;
            }*/
            $this->_params[$name] = $value;
        }
        return $this;
    }
	
	public function clearParams()
    {
        $this->_params = array();
        return $this;
    }
}

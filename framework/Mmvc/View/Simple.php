<?php
/**
 * Simple view class to help enforce private constructs.
 *
 */
class Mmvc_View_Simple
{
    /**
     * List of Variables which will be replaced in the
     * template
     * @var array
     */
    protected $_tpl_vars = array();
    /**
     * Directory where the templates exists
     * @var string
     */
    protected $_tpl_dir = '';

    protected $_options = array();

    
    public function assign($name, $value = null)
    {
        // which strategy to use?
        if (is_string($name)) {
            // assign by name and value
            $this->_tpl_vars[$name] = $value;
        } elseif (is_array($name)) {
            // assign from associative array
            foreach ($name as $key => $val) {
                $this->_tpl_vars[$key] = $val;
            }
        } else {
            die(
                'assign() expects a string or array, received ' . gettype($name)
            );
        }
        return $this;
    }
    
    public function __construct($templateDir=null, $options = array())
    {
        // set template path
        $this->setScriptPath($templateDir);
        $this->_options = $options;
    }
	
	public function setScriptPath($templateDir)
	{
		$this->_tpl_dir = $templateDir;
		if (empty($templateDir)) {
			$this->_tpl_dir = APPLICATION_PATH . DIRECTORY_SEPARATOR . Mmvc_G::get("module_dirctory") . DIRECTORY_SEPARATOR . Mmvc_G::get("view_dirctory");
		}
		
		return true;
	}

    
    public function render($tpl, $tplVars=array())
    {
        if (!is_string($tpl) || $tpl == null) {
            return false;
        }
        // find the script file name using the private method
        $template = $this->_script($tpl);
        
		return $this->_run($template, $tplVars);
    }
	
	protected function _script($name)
    {
        if (preg_match('#\.\.[\\\/]#', $name)) {
            die(
                'Requested scripts may not include parent '.
                'directory traversal ("../", "..\\" notation)'
            );
        }
        if (is_readable($this->_tpl_dir . DIRECTORY_SEPARATOR . $name)) {
            return $this->_tpl_dir . DIRECTORY_SEPARATOR . $name;
        }
        die("Unable to find template " . $this->_tpl_dir . DIRECTORY_SEPARATOR . $name);
    }

    protected function _run($template, $vars, $useEval = false)
    {
		
        if ($vars == null && count($this->_tpl_vars)>0) {
            $vars = $this->_tpl_vars;
        } else {
            $vars = array_merge($vars, $this->_tpl_vars);
        }
		if ($vars!=null) {
            extract($vars);
        }
		ob_start();
        if ($useEval == true) {
            eval('?>'.$template.'<?');
        } else {
            include($template);
        }
        $content = ob_get_clean();
        return $content;
    }

}

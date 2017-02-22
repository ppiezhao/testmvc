<?php
/**
 * Mmvc Controller Abstract
 */
abstract class Mmvc_Controller_Abstract
{
	protected $_view = null;
	protected $_request = null;
	public function __construct($view,$request)
	{
		$this->_view = $view;
		$this->_request = $request;
	}
	
	public function render($tpl = null, $parameters = array())
    {
		
        $view   = $this->initView();
        //$script = $this->getViewScript($tpl);
		
        return $view->render($tpl, $parameters);
    }
	public function initView()
	{
		return $this->_view;
	}
	public function getView()
    {
        return $this->_view;
    }
	public function getRequest()
	{
		return $this->_request;
	}
}

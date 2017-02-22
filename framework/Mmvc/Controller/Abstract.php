<?php
/**
 * Mmvc Controller Abstract
 */
abstract class Mmvc_Controller_Abstract
{
	protected $_view = null;
	public function __construct($view)
	{
		$this->_view = $view;
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
}

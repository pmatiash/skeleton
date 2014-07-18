<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    public $layout = '//layouts/main';

    public $menu = array();

    public $breadcrumbs = array();

    /**
     * @var CHttpRequest Request object
     */
    protected $request;
    
    /**
     * @var Response Response object
     */
    protected $response;
    
    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);

        $this->request = Yii::app()->request;
        $this->response = Yii::app()->response;
    }
}

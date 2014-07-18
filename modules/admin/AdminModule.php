<?php

namespace module\admin;

class AdminModule extends \BaseModule
{
    protected $registerModels=array();

    public $controllerNamespace = 'module\admin\controllers';

	public function init()
	{
        parent::init();

        \Yii::app()->user->loginUrl = ['/admin/auth/login'];
        \Yii::app()->user->setReturnUrl('/admin');
	}


}

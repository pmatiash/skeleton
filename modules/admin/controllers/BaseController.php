<?php

namespace module\admin\controllers;

class BaseController extends \Controller
{
    /**
     * @var string the default layout for the controller view. Defaults to 'admin.views.layouts.main'.
     */
    public $layout='admin.views.layouts.main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();

    /**
     * @var array the breadcrumbs of the current post. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);

        // form
        $path = \Yii::app()->getAssetManager()->publish(\Yii::app()->basePath . '/modules/admin/assets/js/');
        \Yii::app()->clientScript->registerScriptFile($path . '/form.js');
    }


    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'users' => array('@'),
                   'expression' => 'Yii::app()->getUser()->isAdministrator();'
            ),

            // deny acces to any action for non-authorised users
            array(
                'deny',
                'users' => array('*'),
                'deniedCallback' => function(){
                    \Yii::app()->getUser()->loginRequired();
                },
            ),
        );
    }
}
<?php

namespace module\admin\controllers;

class LogController extends \module\admin\controllers\BaseController
{

    public function actionIndex()
    {
        if (!\Yii::app()->user->isAdministrator()) {
            throw new \CHttpException(404,'Page not found');
        }

        $dataProvider = new \CActiveDataProvider('\Model\Log', array(
            'criteria' => array(
                'order' => 'id DESC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            )
        ));

        // render
        $this->render('index', array(
            'dataProvider'   => $dataProvider,
        ));
    }
}
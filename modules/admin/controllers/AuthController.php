<?php

namespace module\admin\controllers;

class AuthController extends  \module\admin\controllers\BaseController
{
    public function accessRules()
    {
        // allow access to login page for non-authorised user
        $rules = parent::accessRules();
        array_unshift($rules, array(
            'allow',
            'actions' => array('login'),
            'users'   => array('*'),
        ));
        return $rules;
    }
    
    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        // display the login form
        if(!$this->request->isPostRequest) {
            $this->layout = 'admin.views.layouts.empty';
            $this->render('login');
            return;
        }
        
        $email = substr($this->request->getParam('email'), 0, 50);
        $password = substr($this->request->getParam('password'), 0, 50);
        
        // check if credentials specified
        if(!$email || !$password) {
            \Yii::app()->user->setFlash('danger', 'Укажите электронную почту и пароль');
            $this->request->redirect($this->createUrl('login'));
        }
        
        // check credentiels
        $identity = new \UserIdentity($email, $password);
        if (!$identity->authenticate()) {
            \Yii::app()->user->setFlash('danger', 'Пользователь не существует или пароль неверный');
            $this->request->redirect($this->createUrl('login'));
        }
        
        // login user
        $duration = $this->request->getParam('remember') ? 3600 * 24 * 30 : 0;
        \Yii::app()->user->login($identity, $duration);

        // show index page
        $this->request->redirect(\Yii::app()->user->getReturnUrl());
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        \Yii::app()->user->logout();
        $this->redirect(\Yii::app()->homeUrl);
    }

}

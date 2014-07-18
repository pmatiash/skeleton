<?php

namespace module\admin\controllers;

class UserController extends \module\admin\controllers\BaseController
{

    public function actionIndex()
    {
        $this->forward('list');
    }
    
    public function actionView($id = null)
    {
        if($id) {
            // get user
            $user = \Model\User::model()->findByPk($id);
            if(!$user) {
                \Yii::app()->user->setFlash('danger', _('User not found'));
                $this->redirect('/user/list');
            }
        } else {
            $user = new \Model\User;
        }

        $this->render('form', array(
            'user'  => $user,
        ));
    }
    
    public function actionList()
    {
        // prepare criteria
        $criteria = new \CDbCriteria;
        $criteria->compare('status', \Model\User::STATUS_ACTIVE);
        $criteria->order = 'name ASC';

        // total user count
        $userCount = \Model\User::model()->count($criteria);

        // prepare pager
        $pagination = new \CPagination($userCount);
        $pagination->pageSize = 20;
        $pagination->applyLimit($criteria);

        // get users
        $userList = \Model\User::model()->findAll($criteria);

        $this->render('list', ['userList' => $userList, 'pagination' => $pagination]);
    }
    
    public function actionNew()
    {
        $this->forward('view');
    }
    
    public function actionSave()
    {
        // get id of user
        $id = (int) $this->request->getParam('id');
        
        if($id) {
            // update existed user
            $user = \Model\User::model()->findByPk($id);
            if(!$user) {
                \Yii::app()->user->setFlash('danger', _('User not found'));
                $this->redirect('/user/list');
            }

        } else {
            // create new user
            $user = new \Model\User;
        }
        
        // set attributes
        $userdata = $this->request->getParam('user');
        $user->setAttributes($userdata);

        // set password
        if(!empty($userdata['password'])) {
            $user->setPassword($userdata['password']);
        }
        
        // save
        if($user->validate()) {
            $user->save();
            $this->response->id = $user->id;
            $this->response->name = $user->name;
            $this->response->raiseSuccess(_('Saved successfully'));

        } else {
            $this->response->invalidated = $user->getErrors();
            $this->response->raiseError(_('Error during saving user profile'));
        }
        
        $this->response->sendJson();
    }
    
    public function actionDelete($id)
    {
        // allow deleting only throw ajax request
        if (!$this->request->isAjaxRequest) {
            $this->request->redirect('/admin/user/list');
        }

        try {
            // get user
            $user = \Model\User::model()->findByPk($id);
            if(!$user) {
                throw new \Exception(_('User not found'));
            }

            // check if this is logged user
            if(\Yii::app()->user->getId() === $user->id) {
                throw new \Exception(_("You can't remove yourself"));
            }

            $user->status = \Model\User::STATUS_DELETED;
            $user->save();
            
            $this->response->raiseSuccess('Removed successfully');

        } catch(\Exception $e) {
            $this->response->raiseError($e->getMessage());
        }

        $this->response->sendJson();
    }
}

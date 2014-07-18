<?php

namespace module\admin\controllers;

use \Model\Page;

class PageController extends \module\admin\controllers\BaseController
{

    /**
     * @param string $id
     * @param null $module
     */
    public function __construct($id,$module=null)
    {
        parent::__construct($id, $module);

        // init TinyMCE
        \Yii::app()->clientScript->addPackage('tinymce', [
            'baseUrl' => \Yii::app()->assetManager->publish(\Yii::app()->basePath . '/vendor/tinymce/tinymce'),
            'js' => ['tinymce.min.js']
        ]);

        \Yii::app()->clientScript->registerPackage('tinymce');
    }

    public function actionList()
    {
        $dataProvider = new \CActiveDataProvider('\Model\Page', array(
            'criteria'=>array(
                'order'=>'id ASC'
            )
        ));

        $this->render('list', array('dataProvider' => $dataProvider));
    }

    public function actionNew()
    {
        $this->forward('view');
    }

    public function actionSave()
    {
        try {

            if (!$_POST) {
                $this->redirect(\Yii::app()->request->urlReferrer);
            }

            $id = \Yii::app()->request->getParam('id');

            if ($id) {
                $page = Page::model()->findByPk($id);
                if (!$page) {
                    throw new \Exception ('Page not found');
                }

            } else {
                $page = new Page();
                $page->data = new \Model\PageData();
            }

            // init form
            $form = new \module\admin\models\PageForm();

            if ($page->isNewRecord) {
                $form->setScenario('new');

            } else {
                $form->setScenario('edit');
                $form->_pageId = $page->id;
            }

            $form->url = \Yii::app()->request->getParam('url');
            $form->attributes = $_POST;


            // validation
            if ($form->validate()) {

                $page->url = $form->url;
                $page->save();
                $form->setScenario('edit');

                // save PageData()
                $page->data->page_id = $page->id;
                $page->data->title = $form->title;

                if (!$form->isEmptyData($form->description)) {
                    $page->data->description = $form->description;
                }

                $page->data->meta_description =  $form->metaDescription;
                $page->data->meta_keywords = $form->metaKeywords;
                $page->data->save();

                \Yii::app()->response->id = $page->id;
                \Yii::app()->response->successMessage = _('Saved successfully');

            } else {
                \Yii::app()->response->invalidated = $form->getErrors();
                \Yii::app()->response->raiseError();
            }


        } catch (\Exception $e) {
            \Yii::app()->response->raiseError($e);
        }

        \Yii::app()->response->sendJson();
    }

    public function actionView($id=null)
    {
        if ($id)
        {
            $page = Page::model()->findByPk($id);
            if (!$page) {
                throw new \Exception ('Page not found');
            }
        } else {
            $page = new Page();
        }

        $this->render('form', array('page' => $page));
    }

    public function actionDelete($id)
    {
        $page = Page::model()->findByPk($id);
        if (!$page) {
            throw new \Exception ('Page not found');
        }

        $page->delete();
    }

    public function actionIndex()
    {
        $this->forward('list');
    }

}
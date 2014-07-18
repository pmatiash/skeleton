<?php

class PageController extends Controller
{
	public function actionView()
	{
        $url = Yii::app()->request->getPathInfo();

        $page = \Model\Page::model()->find('url = :url', array(':url' => '/' . $url));

        if ($page) {
            $this->setPageTitle($page->getTitle());
            Yii::app()->clientScript->registerMetaTag($page->getMetaDescription(), 'description');
            Yii::app()->clientScript->registerMetaTag($page->getMetaKeywords(), 'keywords');
            $this->render('view', array('page' => $page));

        } else {
            $this->pageTitle = _('Page not found');
            $this->render('application.views.error.error404');
        }
	}
}
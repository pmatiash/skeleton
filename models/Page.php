<?php

namespace Model;

/**
 * Class Page
 * @property integer $id
 * @property string $url
 */
class Page extends \CActiveRecord
{
    public $locale = array();

    /**
     * @param string $className
     * @return \CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pages';
    }

    public function relations()
    {
        return [
            'data' => [self::HAS_ONE, '\Model\PageData', 'page_id'],
        ];
    }

    public function beforeSave()
    {
        parent::beforeSave();

        if(substr($this->url, 0, 1) !== '/') {
            $this->url = '/' . $this->url;
        }

        return true;
    }

    public function attributeLabels()
    {
        return array(
            'url' => _('URL'),
        );
    }

    public function getTitle()
    {
        return !$this->getIsNewRecord() ? $this->data->title : null;
    }

    public function getDescription()
    {
        return !$this->getIsNewRecord() ? $this->data->description : null;
    }

    public function getMetaDescription()
    {
        return !$this->getIsNewRecord() ? $this->data->meta_description : null;
    }

    public function getMetaKeywords()
    {
        return !$this->getIsNewRecord() ? $this->data->meta_keywords : null;
    }
}
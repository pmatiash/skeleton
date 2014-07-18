<?php

namespace Model;

/**
 * Class PageData
 *
 * @property integer $id
 * @property integer $page_id
 * @property string title
 * @property string description
 * @property string meta_description
 * @property string meta_keywords
 */
class PageData extends \CActiveRecord
{
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
        return 'pages_data';
    }

    public function attributeLabels()
    {
        return array(
            'title' => _('Title'),
            'description' => _('Description'),
            'meta_description' => _('Meta Description'),
            'meta_keywords' => _('Meta Keywords'),
        );
    }

}
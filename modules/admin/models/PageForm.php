<?php

namespace module\admin\models;

class PageForm extends \CFormModel
{
    public $url;
    public $title;
    public $langCode;
    public $description;
    public $metaDescription;
    public $metaKeywords;

    public $_pageId;

    public function rules()
    {
        return array(
            array('url', 'unique',
                'on' => 'new',
                'message' => _('One of pages already has the same {attribute}:{value}'),
                'className' => '\model\Page'),
            array('url', 'unique',
                'on' => 'edit',
                'criteria' => array('condition' => 'id != :id', 'params' => array(':id' => $this->_pageId)),
                'message' => _('One of pages already has the same {attribute}:{value}'),
                'className' => '\model\Page'),
            array('url, title', 'required', 'message' => _('This field required')),
            array('description, metaDescription, metaKeywords', 'safe'),
        );
    }

    public function isEmptyData($data)
    {
        $result = strip_tags($data);

        return empty($result);
    }

}
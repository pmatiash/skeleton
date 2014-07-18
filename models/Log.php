<?php

namespace Model;

class Log extends \CActiveRecord
{
    /**
     *
     * @param type $className
     * @return Log
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'YiiLog';
    }
    
    public function getTime($format = null)
    {
        if(!$format) {
            return $this->logtime;
        }
        
        return date($format, $this->logtime);
    }
}
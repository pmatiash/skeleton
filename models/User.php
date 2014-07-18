<?php

namespace Model;

/**
 * Users model

 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $name
 * @property string $role
 * @property string $status
 */
class User extends \CActiveRecord
{
    const ROLE_USER             = 'user';
    const ROLE_ADMINISTRATOR    = 'admin';
    
    const STATUS_ACTIVE     = 'active';
    const STATUS_DELETED    = 'deleted';
    
    private $_changedPassword = false;
    
    public function init()
    {
        // set default values
        if(!$this->status) {
            $this->status = self::STATUS_ACTIVE;
        }
        
        if(!$this->salt) {
            $this->salt = self::generateSalt();
        }
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }
    
    public static function getRoleList()
    {
        return array(
            self::ROLE_USER             => _('User'),
            self::ROLE_ADMINISTRATOR    => _('Administrator'),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('email', 'required', 'message' => _('Email field is required')),
            array('email', 'unique', 
                'allowEmpty'    => false, 
                'attributeName' => 'email', 
                'caseSensitive' => false, 
                'className'     => '\Model\User',
                'message'       => _('User with the same email already exists')
            ),
            array('password', 'required', 'message' => _('Password field is required')),
            array('password', 'length', 'min' => 5, 'tooShort' => _('Min length 5 characters')),
            array('name', 'safe'),
            array('salt, role, status', 'required'),
            array('email, name', 'length', 'max' => 50, 'message' => _('Please set less than 50 characters')),
            array('email', 'email', 'checkMX' => true, 'message'  => _('Wrong email')),
            array('role', 'length', 'max' => 20),
            array('role', 'in', 'range' => [self::ROLE_ADMINISTRATOR, self::ROLE_USER]),
            array('status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]),
            array('password', 'unsafe'),
        );
    }
    
    public function beforeSave()
    {
        // password changed - hash it
        if($this->_changedPassword) {
            $hash = $this->getPasswordHash($this->password, $this->salt);
            $this->password = $hash;
            $this->_changedPassword = false;
        }
        
        return true;
    }
    
    public function attributeLabels()
    {
        return array(
            'email'     => _('Email'),
            'password'  => _('Password'),
            'name'      => _('Name'),
            'role'      => _('Role'),
        );
    }

    /**
     * @param string $className active record class name.
     * @return Users the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
    
    /**
     * Generate salt
     * 
     * @param int $length lenght of salt
     * @return string salt
     */
    public static function generateSalt($length = 15)
    {
        $alphabet = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
        $alphabetLength = mb_strlen($alphabet) - 1;
        
        $salt = '';
        for($i = 0; $i < $length; $i++) {
            $salt .= $alphabet[mt_rand(0, $alphabetLength)];
        }
        
        return $salt;
    }
    
    /**
     * Generate password hash from plain password and salt
     * 
     * @param string $password
     * @param string $salt
     * @return string password hash
     */
    public static function getPasswordHash($password, $salt)
    {
        $salt = 'Skel#6543' . str_pad(substr($salt, 0, 22), 22, '0') . '#';

        return crypt($password, $salt);
    }
    
    /**
     * Specify new password and salt
     * 
     * @param string $password new password
     * @return \User
     */
    public function setPassword($password)
    {
        if ($this->isPasswordEquals($password)) {
            return $this;
        }
        
        $this->password = $password;
        $this->_changedPassword = true;

        return $this;
    }

    /**
     * Check if cuurent password equals to passed
     * 
     * @param string $password
     * @return boolean
     */
    public function isPasswordEquals($password)
    {
        if(!$this->salt || !$this->password) {
            return false;
        }
        
        return $this->password === self::getPasswordHash($password, $this->salt);
    }

}

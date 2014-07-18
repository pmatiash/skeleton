<?php

class UserIdentity extends CUserIdentity
{
    /**
     *
     * @var User instance of user
     */
    private $_authorisedUser;
    
    public function authenticate()
    {
        if($this->_authorisedUser) {
            return true;
        }
        
        /* @var $user User */
        $user = \Model\User::model()->findByAttributes(array(
            'email'     => $this->username,
            'status'    => \Model\User::STATUS_ACTIVE,
        ));

        // Check if user with passed email registered
        if (!$user) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }
        
        // Check user's password
        if (!$user->isPasswordEquals($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        }
        
        $this->_authorisedUser = $user;
        
        // user is valid
        $this->errorCode = self::ERROR_NONE;
        return true;
    }
    
    public function getId()
    {
        return $this->_authorisedUser->id;
    }
    
    public function getName()
    {
        return $this->_authorisedUser->name;
    }

}

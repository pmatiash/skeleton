<?php

class WebUser extends CWebUser
{
    /**
     *
     * @var \Model\User instance of user
     */
    private $_userModel;
    
    /**
     * Get instance of user
     * @return type
     */
    public function getModel()
    {   
        if(!$this->_userModel) {
            $this->_userModel = \Model\User::model()->findByPk($this->getId());
        }
        
        return $this->_userModel;
    }
    
    /**
     * Get user's role
     * @return string
     */
    public function getRole()
    {
        return $this->getModel()->role;
    }
    
    public function hasRole($role)
    {
        return $this->getRole() === $role;
    }
    
    public function isAdministrator()
    {
        return $this->hasRole(\Model\User::ROLE_ADMINISTRATOR);
    }
}
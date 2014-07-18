<?php

class BaseModule extends \CWebModule
{
    private $_assetsUrl;

    protected function init()
    {
        parent::init();

        // set controller namespace
        $namespace=implode(NAMESPACE_SEPARATOR, array_slice(explode(NAMESPACE_SEPARATOR, get_class($this)),0,-1));
        $this->controllerNamespace=$namespace. NAMESPACE_SEPARATOR .'controllers';


        // import the module-level models and components
        $this->setImport(array(
            $this->id . '.models.*',
            $this->id . '.components.*',
            $this->id . '.widgets.*',
        ));
    }

    /**
     * Set namespace to module
     * @param array $modules
     */
    public function setModules($modules)
    {
        $modulesConfig=array();
        foreach($modules as $id=>$module){
            if(is_int($id))
            {
                $id=$module;
                $module=array();
            }
            if(!isset($module['class']))
            {
                \Yii::setPathOfAlias($id,$this->getModulePath().DIRECTORY_SEPARATOR.$id);
                $module['class'] = NAMESPACE_SEPARATOR . $id . NAMESPACE_SEPARATOR . ucfirst($id) . 'Module';
            }
            $modulesConfig[$id]=$module;
        }
        parent::setModules($modulesConfig);
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    /**
     * @return string the base URL that contains all published asset files of the module.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl===null) {
            $this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias($this->name.'.assets'));
        }

        return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files of the module.
     */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl=$value;
    }
}
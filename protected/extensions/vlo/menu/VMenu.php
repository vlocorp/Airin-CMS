<?php

class VMenu extends CWidget {

    public $options = array();

    public function init() {
        $this->publishAssets();
    }

    public function run() {
        $roots = Menu::model()->roots()->findAll();

        $this->render('run', array(
            'roots' => $roots,
        ));
    }

    protected static function publishAssets() {
        $assets = dirname(__FILE__) . DIRECTORY_SEPARATOR . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets);
        if (is_dir($assets)) {
            Yii::app()->clientScript->registerCssFile($baseUrl . '/menu.css');
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/menu.js', CClientScript::POS_HEAD);
            //Yii::app()->clientScript->registerCssFile($baseUrl . '/style.css');            
        } else {
            throw new Exception('EClEditor - Error: Couldn\'t find assets to publish.');
        }
    }

    /**
     * function to get child     
     */
    public function getChild($id) {
        $model = Menu::model()->findByPk($id);
        $childrens = $model->children()->findAll();
        return $childrens;
    }

    /**
     * function to generate whether it have arrow span or not for it's child     
     */
    public function generateSpan($object) {        
        if ($this->getChild($object->id))
            return "<span>$object->title</span>";
        else
            return "$object->title";        
    }

}
<?php

namespace backend\modules\admin;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setLayoutPath('@app/views/layouts');
        $this->layout = 'main-reference';
        \Yii::$app->language = 'ru-RU';
        parent::init();

        // custom initialization code goes here
    }
}

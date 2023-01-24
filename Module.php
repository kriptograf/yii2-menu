<?php

namespace kriptograf\menu;

use Yii;
use yii\base\Module as BaseModule;

/**
 * Module for storing menu items in the database
 *
 *
 * @package kriptograf\menu
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class Module extends BaseModule
{
    /** @var string  */
    public $controllerNamespace = 'kriptograf\menu\controllers';

    /** @var string  */
    public $defaultRoute = 'creator';

    /**
     * Initialize module
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function init()
    {
        parent::init();      // custom initialization code goes here
    }
}

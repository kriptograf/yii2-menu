<?php
/**
 * Module for storing menu items in the database
 */
namespace kriptograf\menu;


use Yii;

class Module extends \yii\base\Module {
    
	public $controllerNamespace = 'kriptograf\menu\controllers';
    
	public $defaultRoute = 'creator';

    public function init()
    {
		parent::init();	  // custom initialization code goes here
	}
}

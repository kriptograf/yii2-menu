<?php
namespace kriptograf\menu;


use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use pceuropa\menu\models\Model;

class Module extends \yii\base\Module {
    
	public $controllerNamespace = 'kriptograf\menu\controllers';
    
	public $defaultRoute = 'creator';

    public function init()
    {
		parent::init();	  // custom initialization code goes here
	}
}

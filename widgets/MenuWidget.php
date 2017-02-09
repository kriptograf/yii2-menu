<?php

namespace kriptograf\menu\widgets;

use kriptograf\menu\models\Menu;
use kriptograf\menu\models\MenuItem;
use yii\base\Widget;

class MenuWidget extends Widget
{
	public $code;

	public function init()
    {
        parent::init();
        if ($this->code === null) {
            $this->code = 'bottom';
        }
    }

    public function run()
    {
        $menu = Menu::find()->where(['code'=>$this->code, 'status'=>1])->one();
        
        if(!$menu)
        {
            return false;
        }

        $data = MenuItem::getItems($menu->id);

		return $this->render('index', [
            'data'=>$data,
            'type'=>$menu->type,
        ]);
    }
}

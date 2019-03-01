<?php
/**
 * Widget menu to site view
 */
namespace kriptograf\menu\widgets;

use kriptograf\menu\models\Menu;
use kriptograf\menu\models\MenuItem;
use yii\base\Widget;

class MenuWidget extends Widget
{
    /**
     * System name menu for current widget
     * @var string
     */
    public $code;
    
    /**
     * CSS class for tag ul
     */
    public $cssClass = '';

	public function init()
    {
        parent::init();
        if ($this->code === null) {
            return false;
        }
    }

    public function run()
    {
        /**
         * Find the menu by code(system name) and active status
         */
        $menu = Menu::find()->where(['code'=>$this->code, 'status'=>Menu::STATUS_ENABLED])->one();

        /**
         * If menu not found, return false
         */
        if(!$menu)
        {
            return false;
        }

        /**
         * Get menu items
         */
        $data = MenuItem::getItems($menu->id);

		return $this->render('index', [
            'data'=>$data,
            'type'=>$menu->type,
            'cssClass'=>$this->cssClass
        ]);
    }
}

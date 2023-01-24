<?php

namespace kriptograf\menu;

use yii\web\AssetBundle;

/**
 * Class MenuAsset
 *
 *
 * @package kriptograf\menu
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class MenuAsset extends AssetBundle
{
    /** @var string  */
    public $sourcePath = '@vendor/kriptograf/yii2-menu/assets';

    /** @var string  */
    public $baseUrl    = '@web';

    /** @var string[]  */
    public $js         = [
        'js/Sortable.min.js',
        'js/menu.js',
    ];

    /** @var string[]  */
    public $depends    = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

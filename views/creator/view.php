<?php

use pceuropa\menu\Menu;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\grid\GridView;

$this->title = Yii::t('app', 'View items');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Menu'),
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('h1', $model->menu_name);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'code',
        'description',
        ['class' => 'yii\grid\ActionColumn',],
    ],
]);
/*NavBar::begin();
echo Nav::widget([ 'options' => ['class' => 'navbar-nav navbar-left'],
					'items' => Menu::NavbarLeft($model->menu_id) ]);

echo Nav::widget([ 'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => Menu::NavbarRight($model->menu_id)]);		
NavBar::end();*/

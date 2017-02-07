<?php
#Copyright (c) 2017 Rafal Marguzewicz pceuropa.net LTD
use pceuropa\menu\Menu;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Menu');
$this->params['breadcrumbs'][] = $this->title;

echo Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']);
 
echo  GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		'name',
		'code',
		'description',
		['class' => 'yii\grid\ActionColumn',],
	],
]); 


?>

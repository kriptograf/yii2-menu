<?php

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
		'type',
		[
			'class' => 'yii\grid\ActionColumn',
		],
	],
]); 


?>

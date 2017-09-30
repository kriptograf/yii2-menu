<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Menu');
$this->params['breadcrumbs'][] = $this->title;

echo Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']);
 
echo  GridView::widget([
    'id'=>'kv-grid-menu',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_menu_items', ['model'=>$model]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'],
			'expandOneOnly'=>true
		],
		'name',
		'code',
		'description',
		'type',
		[
			'class' => 'yii\grid\ActionColumn',
		],
	],
    'pjax'=>true,
]); 


?>

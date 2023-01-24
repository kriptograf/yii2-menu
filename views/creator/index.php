<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title                   = Yii::t('app', 'Menu');
$this->params['breadcrumbs'][] = $this->title;

echo Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success']);

echo GridView::widget([
    'id'           => 'kv-grid-menu',
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'code',
        'description',
        'type',
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{items}{update}{delete}',
            'buttons'  => [
                'items' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>', Url::toRoute([
                        '/menu/items/index',
                        'id' => $model->id,
                    ]), ['title' => Yii::t('app', 'Items')]);
                },
            ],
        ],
    ],
    'pjax'         => true,
]);

<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => $model->getChilds(),
]);
?>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'menu_id',
            'value'     => function ($model) {
                return $model->menu->name;
            },
        ],
        [
            'attribute' => 'parent_id',
            'value'     => function ($model) {
                return $model->parent->title;
            },
        ],
        'title',
        /*[
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                return $data->name; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
        ],*/
        [
            'class' => 'yii\grid\ActionColumn',
            // you may configure additional properties here
        ],
    ],
]); ?>
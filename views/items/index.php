<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 07.02.17
 * Time: 21:39
 */
use kartik\grid\GridView;
?>

<p>
    <a class="btn btn-success" href="<?php echo \yii\helpers\Url::toRoute(['/menu/items/create', 'id'=>$id]);?>"><?php echo Yii::t('app','Create');?></a>
</p>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_menu_items', ['model'=>$model, 'id'=>$model->id]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'expandOneOnly'=>true
        ],
        'menu_id',
        'parent_id',
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
]);?>

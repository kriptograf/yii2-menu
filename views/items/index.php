<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 07.02.17
 * Time: 21:39
 */
use yii\grid\GridView;
?>

<p>
    <a href="<?php echo \yii\helpers\Url::toRoute(['/menu/items/create', 'id'=>$id]);?>"><?php echo Yii::t('app','Create');?></a>
</p>
<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
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

<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 07.02.17
 * Time: 21:51
 */
kriptograf\menu\MenuAsset::register($this);
$this->title = Yii::t('app', 'Edit item from menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu'), 'url' => ['index', 'id'=>$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'id'=>$id
]) ?>

<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

kriptograf\menu\MenuAsset::register($this);
$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'name'); ?>
	<?= $form->field($model, 'code'); ?>
	<?= $form->field($model, 'description'); ?>
	<?= $form->field($model, 'status')->checkbox(); ?>
	<?=  Html::submitButton('Create', ['class' => 'btn btn-success pull-right col-xs-12']); ?>
	<?php ActiveForm::end(); ?>
</div>

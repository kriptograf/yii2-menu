<?php
use kriptograf\menu\models\Menu;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="menu-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

	<?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>

	<?= $form->field($model, 'type')->dropDownList($model->getTypes(), [
		'prompt'=>Yii::t('app', 'Select a type menu'),
	]); ?>

	<?= $form->field($model, 'description')->textarea(); ?>

	<?= $form->field($model, 'status')->checkbox();?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>







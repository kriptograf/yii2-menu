<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="menu-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model->getParentItems($id), [
        'prompt' => 'Select parent item',
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput() ?>

    <?= $form->field($model, 'class')->textInput() ?>

    <?= $form->field($model, 'attr_title')->textInput() ?>

    <?= $form->field($model, 'target')->textInput() ?>

    <?= $form->field($model, 'rel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'encode')->checkbox(); ?>

    <?= $form->field($model, 'status')->checkbox(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


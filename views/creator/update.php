<?php
kriptograf\menu\MenuAsset::register($this);
$this->title = Yii::t('app', 'Update');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Menu'),
    'url'   => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="menu-update">
    <?= $this->render('_form', ['model' => $model]); ?>
</div>

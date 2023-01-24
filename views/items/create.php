<?php

kriptograf\menu\MenuAsset::register($this);
$this->title                   = Yii::t('app', 'Add item to menu');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Menu'),
    'url'   => [
        'index',
        'id' => $id,
    ],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'id'    => $id,
]) ?>

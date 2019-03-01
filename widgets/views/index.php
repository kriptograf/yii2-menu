<?php
echo \yii\bootstrap\Nav::widget([
    'items'=>$data,
    'options' => [
        'class' =>($cssClass) ? $cssClass : $type,
    ],
]);
?>

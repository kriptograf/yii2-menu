Menu module
===========
Menu module for you site

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require --prefer-dist kriptograf/yii2-menu "*"
```

or add

```
"kriptograf/yii2-menu": "*"
```

to the require section of your `composer.json` file.

Add the following code to config file Yii2
```php
'modules' => [
	    'menu' => [
            'class' => '\kriptograf\menu\Module',
        ],
]
```

Add the following code to config file Yii2 for settings module kartik-v gridview
```php
    'modules' => [
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ]
        ]
    ];
```

## Configuration

### 1. Create database schema

Make sure that you have properly configured `db` application component and run the following command:

```bash
$ php yii migrate/up --migrationPath=@vendor/kriptograf/yii2-menu/migrations

```

### 2. Getting started for admin
/menu/creator

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php echo \kriptograf\menu\widgets\MenuWidget::widget(['code'=>'placement_you_code'])?>

```
<?php

namespace kriptograf\menu\models;

use Yii;
use kriptograf\menu\models\Menu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string $title
 * @property string $url
 * @property string $class
 * @property string $attr_title
 * @property string $target
 * @property string $rel
 * @property integer $sort
 * @property integer $status
 *
 * @property Menu $menu
 */
class MenuItem extends \yii\db\ActiveRecord
{
	public static function tableName() 
	{ 
		return 'menu_item';
	}


	public function rules()
	{
		return [
			[['menu_id', 'title', 'url'], 'required'],
			[['status', 'parent_id', 'menu_id'], 'integer'],
            [['title','url','class', 'attr_title', 'target', 'rel'], 'string'],
			[['title', 'url', 'class', 'attr_title', 'target', 'rel'], 'max'=>255],
			['sort', 'safe'],
            ['status', 'default', 'value' => 1, 'on' => 'insert'],
		];
	}

	/**
	 * Return attribute labels
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'id'          => Yii::t('app', 'Id'),
            'parent_id'   => Yii::t('app', 'Parent menu item'),
			'menu_id'     => Yii::t('app', 'Menu'),
			'title'       => Yii::t('app', 'Title'),
			'url'         => Yii::t('app', 'Url'),
			'class'       => Yii::t('app', 'CSS Class'),
			'attr_title'  => Yii::t('app', 'Title attribute'),
			'target'      => Yii::t('app', 'Target attribute'),
			'rel'         => Yii::t('app', 'Rel attribute'),
			'sort'        => Yii::t('app', 'Sort'),
			'status'      => Yii::t('app', 'Published'),
		];
	}

	/**
	 * Return list options to dropdown list
	 * @return array
	 */
	public function getParentItems()
	{
		$parents = self::find()->where(['parent_id'=>0])->all();
		return ArrayHelper::map($parents, 'id', 'title');
	}

	/**
	 * Relation BELONGS_TO to menu table
	 * @return \yii\db\ActiveQuery
	 */
	public function getMenu()
	{
		return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
	}
}

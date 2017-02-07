<?php

namespace kriptograf\menu\models;

use Yii;
use kriptograf\menu\models\MenuItem;
/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property integer $status
 *
 * @property MenuItem[] $menuItems
 */
class Menu extends \yii\db\ActiveRecord
{
	const TYPE_TABS = 'nav-tabs';
	const TYPE_PILLS = 'nav-pills';
	const TYPE_STACKED = 'nav-stacked';
	const TYPE_JUSTIFIED = 'nav-justified';

	public static function tableName() 
	{ 
		return 'menu';
	}


	public function rules()
	{
		return [
			[['status'], 'integer'],
            [['name','code','description','type'], 'string'],
			[['name', 'code', 'type'], 'max'=>255],
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
            'name'        => Yii::t('app', 'Menu name'),
			'code'        => Yii::t('app', 'System name'),
			'description' => Yii::t('app', 'Description'),
			'status'      => Yii::t('app', 'Published'),
		];
	}

	/**
	 * Relation HAS_MANY to menu items
	 * @return \yii\db\ActiveQuery
	 */
	public function getMenuItems()
	{
		return $this->hasMany(MenuItem::className(), ['menu_id' => 'id']);
	}

	/**
	 * Return availabile types menu
	 * @return array
	 */
	public function getTypes()
	{
		return [
			self::TYPE_TABS => 'Tabs',
			self::TYPE_PILLS => 'Pills',
			self::TYPE_STACKED => 'Stacked',
			self::TYPE_JUSTIFIED => 'Justified'
		];
	}

	/**
	 * Return view string type value
	 * @return mixed
	 */
	public function getType()
	{
		$types = $this->getTypes();
		return $types[$this->type];
	}
}

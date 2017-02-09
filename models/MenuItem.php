<?php

namespace kriptograf\menu\models;

use Yii;
use kriptograf\menu\models\Menu;
use yii2tech\ar\position\PositionBehavior;
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

	public function behaviors()
	{
		return [
			[
				'class' => PositionBehavior::className(),
				'positionAttribute' => 'sort',
			],
		];
	}

	public function rules()
	{
		return [
			[['menu_id', 'title', 'url'], 'required'],
			[['status', 'parent_id', 'menu_id'], 'integer'],
            [['title','url','class', 'attr_title', 'target', 'rel'], 'string'],
			[['parent_id'], 'default', 'value'=>0],
			['sort', 'safe'],
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
	 * Relations childs items
	 * @return \yii\db\ActiveQuery
	 */
	public function getChilds()
	{
		return $this->hasMany(MenuItem::className(), ['parent_id'=>'id']);
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

	/**
	 * Return array items to Menu widget
	 * @param $menu_id
	 * @return array
	 */
	public static function getItems($menu_id)
	{
		$out = [];
		$items = self::find()->where(['menu_id'=>$menu_id, 'status'=>1])->orderBy('sort')->all();
		foreach ($items as $key => $item)
		{
			$out[$key]['label'] = $item->title;
			$out[$key]['url'] = $item->url;
			if($item->childs)
			{
				foreach ($item->childs as $k => $child) {
					$out[$key]['items'][$k] = [
						'label'=>$child->title,
						'url'=>$child->url,
					];
				}
			}
		}

		return $out;
	}
}

<?php

namespace kriptograf\menu\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "menu".
 *
 * @property integer    $id
 * @property string     $name
 * @property string     $code
 * @property string     $type
 * @property string     $description
 * @property integer    $status
 *
 * @property MenuItem[] $menuItems
 */
class Menu extends ActiveRecord
{
    /**
     * Types menu uses bootstrap classes
     */
    const TYPE_TABS      = 'nav-tabs';
    const TYPE_PILLS     = 'nav-pills';
    const TYPE_STACKED   = 'nav-stacked';
    const TYPE_JUSTIFIED = 'nav-justified';

    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                ['status'],
                'integer',
            ],
            [
                [
                    'name',
                    'code',
                    'description',
                    'type',
                ],
                'string',
            ],
        ];
    }

    /**
     * Return attribute labels
     *
     * @return array
     */
    public function attributeLabels(): array
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
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems(): \yii\db\ActiveQuery
    {
        return $this->hasMany(MenuItem::className(), ['menu_id' => 'id']);
    }

    /**
     * Return available types menu
     *
     * @return array
     */
    public function getTypes(): array
    {
        return [
            self::TYPE_TABS      => 'Tabs',
            self::TYPE_PILLS     => 'Pills',
            self::TYPE_STACKED   => 'Stacked',
            self::TYPE_JUSTIFIED => 'Justified',
        ];
    }

    /**
     * Return view string type value
     *
     * @return string
     */
    public function getType(): string
    {
        $types = $this->getTypes();

        return $types[$this->type];
    }
}

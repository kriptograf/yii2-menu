<?php
/**
 * @todo Добавить выпадающие списки значений для атрибутов ссылки
 * @todo Сделать возможность добавления дата атрибутов
 */

namespace kriptograf\menu\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii2tech\ar\position\PositionBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $menu_id
 * @property string  $title
 * @property string  $url
 * @property string  $class
 * @property string  $attr_title
 * @property string  $target
 * @property string  $rel
 * @property integer $sort
 * @property integer $status
 * @property integer $encode
 *
 * @property Menu    $menu
 */
class MenuItem extends ActiveRecord
{
    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return 'menu_item';
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class'             => PositionBehavior::className(),
                'positionAttribute' => 'sort',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [
                [
                    'menu_id',
                    'title',
                    'url',
                ],
                'required',
            ],
            [
                [
                    'status',
                    'parent_id',
                    'menu_id',
                ],
                'integer',
            ],
            [
                [
                    'title',
                    'url',
                    'class',
                    'attr_title',
                    'target',
                    'rel',
                ],
                'string',
            ],
            [
                [
                    'parent_id',
                    'encode',
                ],
                'default',
                'value' => 0,
            ],
            [
                'sort',
                'safe',
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
            'id'         => Yii::t('app', 'Id'),
            'parent_id'  => Yii::t('app', 'Parent menu item'),
            'menu_id'    => Yii::t('app', 'Menu'),
            'title'      => Yii::t('app', 'Title'),
            'url'        => Yii::t('app', 'Url'),
            'class'      => Yii::t('app', 'CSS Class'),
            'attr_title' => Yii::t('app', 'Title attribute'),
            'target'     => Yii::t('app', 'Target attribute'),
            'rel'        => Yii::t('app', 'Rel attribute'),
            'sort'       => Yii::t('app', 'Sort'),
            'status'     => Yii::t('app', 'Published'),
            'encode'     => Yii::t('app', 'Encode ldbel'),
        ];
    }

    /**
     * Relations childs items
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChilds(): \yii\db\ActiveQuery
    {
        return $this->hasMany(MenuItem::className(), ['parent_id' => 'id']);
    }

    /**
     * Relation belongs_to parent item
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent(): \yii\db\ActiveQuery
    {
        return $this->hasOne(MenuItem::className(), ['id' => 'parent_id']);
    }

    /**
     * Return list options to dropdown list
     *
     * @param integer $menu_id
     *
     * @return mixed
     */
    public function getParentItems(int $menu_id)
    {
        $parents = self::find()->where([
            'parent_id' => 0,
            'menu_id'   => $menu_id,
            'status'    => self::STATUS_ACTIVE,
        ])->all();

        return ArrayHelper::map($parents, 'id', 'title');
    }

    /**
     * Relation BELONGS_TO to menu table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    /**
     * Return array items to Menu widget
     *
     * @param integer $menu_id
     * @param array   $options       optional, the HTML attributes of the item container (LI).
     * @param array   $childOptions  optional, the HTML attributes of the item subcontainer (LI).
     *
     * @return array
     */
    public static function getItems(int $menu_id, array $options = [], array $childOptions = []): array
    {
        $out   = [];

        $items = self::find()->where([
            'menu_id' => $menu_id,
            'status'  => self::STATUS_ACTIVE,
        ])->orderBy('sort')->all();

        foreach ($items as $key => $item) {
            $out[$key]['label']       = $item->title;
            $out[$key]['url']         = $item->url;
            $out[$key]['options']     = $options;
            $out[$key]['linkOptions'] = [
                'class'  => $item->class,
                'title'  => $item->attr_title,
                'target' => $item->target,
                'rel'    => $item->rel,
            ];
            $out[$key]['encode']      = $item->encode;

            if ($item->childs) {
                foreach ($item->childs as $k => $child) {
                    $out[$key]['items'][$k] = [
                        'label'       => $child->title,
                        'url'         => $child->url,
                        'options'     => $childOptions,
                        'linkOptions' => [
                            'class'  => $child->class,
                            'title'  => $child->attr_title,
                            'target' => $child->target,
                            'rel'    => $child->rel,
                        ],
                        'encode'      => $child->encode,
                    ];
                }
            }
        }

        return $out;
    }
}

<?php

namespace common\modules\menu\models;


use common\behaviors\SlugBehavior;
use Yii;
use yii\caching\TagDependency;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;

use common\modules\language\models\Language;
use common\modules\language\components\ModelBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $menu_id Идентификатор
 * @property string $title Название
 * @property int $type Тип
 * @property int $alias Тип
 *
 * @property MenuItems[] $menuItems
 */
class Menu extends \yii\db\ActiveRecord
{
    const SCENARIO_SEARCH = "search";
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @param string $menu_alias
     * @return mixed
     */
    public static function cacheHttpTag($menu_alias = "")
    {
        $mneu = self::find()->alias($menu_alias);
        return MenuItems::find()->andWhere(['menu_id' => $mneu->menu_id])->orderBy(['sort' => SORT_DESC])->one()->{MenuItems::primaryKey()[0]};
    }

    /**
     * @inheritdoc
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }

    /**
     * @return array
     */
//    public function behaviors()
//    {
//        return ArrayHelper::merge(parent::behaviors(), [
//            'slug' => [
//                'class' => SlugBehavior::class,
//                'attribute' => 'alias',
//                'attribute_title' => 'title',
//            ],
//        ]); // TODO: Change the autogenerated stub
//
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'default', 'value' => null],
            [['type'], 'integer'],
            [['alias', 'title'], 'safe'],
            [['alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => Yii::t('app', 'Menu ID'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItems()
    {
        return $this->hasMany(MenuItems::class, ['menu_id' => 'menu_id'])->inverseOf('menu')->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuItemsParents()
    {
        return $this->hasMany(MenuItems::class, ['menu_id' => 'menu_id'])->andWhere(['menu_items.menu_item_parent_id' => NULL])->orderBy(['sort' => SORT_ASC])->inverseOf('menu');
    }

    public function fields()
    {
        return array(
            'title' => function ($model) {
                return array_key_exists(\Yii::$app->language,
                    $model->title) ? $model->title[\Yii::$app->language] : $model->title['ru'];
            },
            'childs' => function ($model) {
                return $model->menuItemsParents;
            },
            'type'
        );
    }

}

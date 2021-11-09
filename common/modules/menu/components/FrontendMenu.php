<?php

namespace common\modules\menu\components;

use common\modules\language\models\Language;
use common\modules\menu\models\MenuItems;
use common\modules\settings\models\Settings;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

class FrontendMenu extends MenuRender
{

    public function init()
    {
        parent::init();
    }

    public function beforeRenderMenu()
    {
        echo '<div class="collapse navbar-collapse" id="main_nav">';
        echo '    <ul class="navbar-nav ml-auto">';
    }

    public function renderHelperButtons()
    {
        if (\Yii::$app->user->isGuest) {
            echo '<li class="nav-item mobile-hide ml-3">';
            echo Html::a(__('Join now'), ['site/signup'], ['class' => 'btn btn-light']);
            echo '    <a class="btn btn-primary ml-1" href="#modal_login" data-toggle="modal"> 
                    <i class="fa fa-user-circle mr-1"></i> Sign in </a>';
            echo '</li>';
        } else {
            echo '<li class="nav-item mobile-hide ml-3">';
            echo '    <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle mr-1"></i>' . \Yii::$app->user->identity->profile->first_name . '
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="' . Url::to(['user/profile']) . '">Profile</a>
                            <a class="dropdown-item" href="' . Url::to(['user/favorites']) . '">My favorites</a>
                            <a class="dropdown-item" href="' . Url::to(['user/classes']) . '">Classes</a>
                            <a class="dropdown-item text-danger" href="/site/logout">Log out</a>
                          </div>
                        </div>';
            echo '</li>';
        }
    }

    public function afterRenderMenu()
    {
        $this->renderHelperButtons();
        echo '    </ul>';
        echo '</div>';
    }

    public function beginRenderItem()
    {

        if ($this->has_child) {
            echo '<li>
                    <a href="#" class="top10 nav-link"> ' . $this->item->title[Yii::$app->language] . '
                        <img class="top-chevron" src="/images/right-chevron.png" alt="">';
        } else {
            echo '<li class="nav-item"><a href="' . $this->item->url . '" class="nav-link ' . ($this->is_active() ? "active" : "") . '">' . $this->item->title[Yii::$app->language]
                . '</a>';
        }

    }

    private function menuItemSetting()
    {
        $model = MenuItems::findOne($this->item->menu_item_id);
        $langs = Language::find()->active()->all();

        echo '<div  class="menu-item-settings" menuitem-id="' . $this->item->menu_item_id . '"> ';
        $form = ActiveForm::begin([
            'id' => 'menu-item-form',
            'options' => ['data-pjax' => true, ['enctype' => 'multipart/form-data']]
        ]); ?>
        <div class="panel panel-default">
            <ul class="nav customtab nav-tabs">
                <?php foreach ($langs as $lang): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($lang->code == Yii::$app->language) ? 'active' : '' ?>" href="#flanguage-<?= $lang->code ?>" data-toggle="tab"><?= mb_strtoupper($lang->code) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" style="margin: 0">
                <?php
                foreach ($langs as $lang): ?>
                    <div class="tab-pane fade <?= ($lang->code == Yii::$app->language) ? 'active show' : '' ?>" style="opacity: 1" id="flanguage-<?= $lang->code ?>">
                        <div class="panel panel-default">
                            <div class="panel-wrapper">
                                <div class="panel-body">
                                    <?= $form->field($model, 'title[' . $lang->code . ']')->textInput() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        echo $form->field($model, 'url');
        echo $form->field($model, 'icon');
        echo $form->field($model, 'menu_item_id')->hiddenInput()->label(false);
        echo Html::submitButton(Yii::t('app', 'Menu Update'), ['class' => 'btn btn-primary']);
        echo Html::a(Yii::t('app', 'Menu Remove'), '#menuitem', [
            'class' => 'btn btn-danger pull-right',
            'title' => 'delete',
            'data-query' => 'delete',
            'data-query-delete-selector' => 'li[menuitem-id=' . $this->item->menu_item_id . ']',
            'data-query-method' => 'POST',
            'data-query-url' => yii\helpers\Url::to(["/menu/menu/delete-item"]),
            'data-query-confirm' => Yii::t('app', 'Are you sure?'),
            'data-query-params' => 'id=' . $this->item->menu_item_id . '&menuItemDelete=delete'
        ]);
        ActiveForm::end();
        echo "</div>";
    }

    public function endRenderItem()
    {
        if ($this->has_child):
            echo '</ul></li>';
        else:
            echo '</li>';
        endif;
    }

    public function beginRenderItemChild()
    {
        echo ' <a class="top-food" href="' . $this->item->url . '">' . $this->item->title[Yii::$app->language] . '</a>';
    }

    public function endRenderItemChild()
    {
//        echo "</li>";
    }

    public function beforeRenderItemChilds()
    {
        echo '<div>';
    }

    public function afterRenderItemChilds()
    {
        echo '</div>';
    }
}

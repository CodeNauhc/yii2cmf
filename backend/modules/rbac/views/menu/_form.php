<?php

use rbac\AutocompleteAsset;
use rbac\models\Menu;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model rbac\models\Menu */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="box box-primary">
    <div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

    <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>

    <?= $form->field($model, 'icon')->widget(\backend\widgets\iconpicker\IconPickerWidget::className()) ?>

    <?= $form->field($model, 'order')->input('number') ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('rbac', 'Create') : Yii::t('rbac', 'Update'), ['class' => 'btn btn-flat btn-block bg-maroon']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
AutocompleteAsset::register($this);

$options1 = Json::htmlEncode([
    'source' => Menu::find()->select(['name'])->column(),
]);
$this->registerJs("$('#parent_name').autocomplete($options1);");

$options2 = Json::htmlEncode([
    'source' => Menu::getSavedRoutes(),
]);
$this->registerJs("$('#route').autocomplete($options2);");

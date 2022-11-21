<?php

use yii\helpers\ArrayHelper;

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

use app\models\ValueTypes;

/** @var yii\web\View $this */
/** @var app\models\PropertyTemplate $model */
/** @var yii\widgets\ActiveForm $form */

$valueTypes = ArrayHelper::map(ValueTypes::find()->all(), 'id', 'name');

?>

<div class="property-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <br />
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <br />
    <?= $form->field($model, 'valueType')->dropDownList($valueTypes) ?>

    <br />
    <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>
    <p> Uno abajo del otro </p>

    <br />
    <div class="form-group">
        <?= Html::submitButton('Grabar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

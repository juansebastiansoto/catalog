<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MaterialProperties $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

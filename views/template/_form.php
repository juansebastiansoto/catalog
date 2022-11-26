<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

use app\models\ValueTypes;

/** @var yii\web\View $this */
/** @var app\models\Template $model */
/** @var yii\widgets\ActiveForm $form */

$valueTypes = ArrayHelper::map(ValueTypes::find()->all(), 'id', 'name');

?>

<div class="template-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength'=> true]) ?>

        <?= $form->field($model, 'namePattern')->textarea(['rows'=> 6]) ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <br />
                    <h3><i class="glyphicon glyphicon-envelope">Propiedades</i></h3>
                </div>
                <div class="panel-body">
                    <?php
                        DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper',
                            // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items',
                            // required: css class selector
                            'widgetItem' => '.item',
                            // required: css class
                            'limit' => 50,
                            // the maximum times, an element can be cloned (default 999)
                            'min' => 1,
                            // 0 or 1 (default 1)
                            'insertButton' => '.add-item',
                            // css class
                            'deleteButton' => '.remove-item',
                            // css class
                            'model' => $modelProperties[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'name',
                                'valueType',
                                'options',
                            ],
                        ]);
                        ?>

                    <div class="container-items">
                        <!-- widgetContainer -->
                        <?php foreach ($modelProperties as $i => $modelProperty): ?>
                        <div class="item panel panel-default">
                            <!-- widgetBody -->
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <?php
                                echo Html::button(Html::tag('i', '+', ['class' => 'glyphicon glyphicon-plus']), ['class' => 'add-item btn btn-success btn-xs']);
                                echo Html::button(Html::tag('i', '-', ['class' => 'glyphicon glyphicon-minus']), ['class' => 'remove-item btn btn-danger btn-xs']);
                                        ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <?= $form->field($modelProperty, "[{$i}]name")->textInput() ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelProperty, "[{$i}]valueType")->dropDownList($valueTypes)
                                            ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($modelProperty, "[{$i}]options")->textarea(['rows'=> 6]) ?>
                                    </div>
                                </div><!-- .row -->

                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>

            <br />
            <div class="form-group">
                <?= Html::submitButton('Save', ['class'=> 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

</div>
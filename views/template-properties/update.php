<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TemplateProperties $model */

$this->title = 'Update Template Properties: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Template Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'property' => $model->property]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="template-properties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

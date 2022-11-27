<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Template $model */

$this->title = 'Actualizar plantilla: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plantillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelProperties' => $modelProperties,
    ]) ?>

</div>

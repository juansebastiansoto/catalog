<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PropertyTemplate $model */

$this->title = 'Actualizar la plantilla de propiedad: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plantilla de propiedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="property-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

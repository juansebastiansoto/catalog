<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PropertyTemplate $model */

$this->title = 'Crear nueva plantilla';
$this->params['breadcrumbs'][] = ['label' => 'Plantilla de propiedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Template $model */

$this->title = 'Crear plantilla';
$this->params['breadcrumbs'][] = ['label' => 'Plantillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelProperties' => $modelProperties,
    ]) ?>

</div>

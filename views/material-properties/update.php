<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaterialProperties $model */

$this->title = 'Update Material Properties: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Material Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'property' => $model->property]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-properties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaterialProperties $model */

$this->title = 'Create Material Properties';
$this->params['breadcrumbs'][] = ['label' => 'Material Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-properties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

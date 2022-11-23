<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TemplateProperties $model */

$this->title = 'Create Template Properties';
$this->params['breadcrumbs'][] = ['label' => 'Template Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-properties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

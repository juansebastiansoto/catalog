<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PropertyTemplate $model */

use app\models\ValueTypes;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plantilla de propiedades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$valueType = ValueTypes::findOne($model->valueType);

?>
<div class="property-template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que quiere borrar el objeto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            array(
                'attribute' => 'valueType',
                'value' => $valueType->name,
            ),
            'options:ntext',
        ],
    ]) ?>

</div>

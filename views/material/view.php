<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\models\MaterialPropertiesSearch;

/* Datos de posición */
$searchModel = new MaterialPropertiesSearch();
$searchModel->id = $model->id;
$dataProvider = $searchModel->search(['id' => $model->id]);

/** @var yii\web\View $this */
/** @var app\models\Material $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Materiales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea borrar el material?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'template',
            'name',
        ],
    ]) ?>

</div>

<div class="bill-pos-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'template0.name',
            'value',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
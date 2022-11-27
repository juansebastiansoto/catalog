<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use app\models\TemplatePropertiesSearch;

/* Datos de posición */
$searchModel = new TemplatePropertiesSearch();
$searchModel->id = $model->id;
$dataProvider = $searchModel->search(['id' => $model->id]);

/** @var yii\web\View $this */
/** @var app\models\Template $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plantillas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea borrar la plantilla?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'namePattern:ntext',
        ],
    ]) ?>

</div>

<div class="bill-pos-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'shortname',
            array(
                'attribute' => 'name',
                'value' => 'valueType0.name',
                'label' => 'Tipo de dato',
            ),
            'options',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
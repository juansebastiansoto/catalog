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
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
            'valueType0.name',
            'options',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
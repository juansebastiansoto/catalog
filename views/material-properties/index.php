<?php

use app\models\MaterialProperties;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modelsMaterialPropertiesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Material Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-properties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Material Properties', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'property',
            'tempate',
            'value',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MaterialProperties $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'property' => $model->property]);
                 }
            ],
        ],
    ]); ?>


</div>

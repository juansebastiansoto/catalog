<?php

use app\models\PropertyTemplate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;

use app\models\ValueTypes;

/** @var yii\web\View $this */
/** @var app\models\PropertyTemplateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Plantillas de propiedades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-template-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear nueva plantilla', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'valueType',
                'value' => function($model) {
                    $valueTypes = ValueTypes::findOne($model->valueType);
                    return $valueTypes->name;
                },
                'filter' => ArrayHelper::map(ValueTypes::find()->all(), 'id', 'name'),
            ],            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PropertyTemplate $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

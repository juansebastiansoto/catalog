<?php

use app\models\TemplateProperties;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TemplatePropertiesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Template Properties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-properties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Template Properties', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'property',
            'name',
            'shortname',
            'valueType',
            'options:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TemplateProperties $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'property' => $model->property]);
                 }
            ],
        ],
    ]); ?>


</div>

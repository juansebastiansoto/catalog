<?php

namespace app\controllers;

use app\models\TemplateProperties;
use app\models\TemplatePropertiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplatePropertiesController implements the CRUD actions for TemplateProperties model.
 */
class TemplatePropertiesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TemplateProperties models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TemplatePropertiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TemplateProperties model.
     * @param string $id ID de la propiedad en el template
     * @param string $property ID de la propiedad
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $property)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $property),
        ]);
    }

    /**
     * Creates a new TemplateProperties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TemplateProperties();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'property' => $model->property]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TemplateProperties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID de la propiedad en el template
     * @param string $property ID de la propiedad
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $property)
    {
        $model = $this->findModel($id, $property);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'property' => $model->property]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TemplateProperties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID de la propiedad en el template
     * @param string $property ID de la propiedad
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $property)
    {
        $this->findModel($id, $property)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TemplateProperties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID de la propiedad en el template
     * @param string $property ID de la propiedad
     * @return TemplateProperties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $property)
    {
        if (($model = TemplateProperties::findOne(['id' => $id, 'property' => $property])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use app\models\MaterialProperties;
use app\modelsMaterialPropertiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialPropertiesController implements the CRUD actions for MaterialProperties model.
 */
class MaterialPropertiesController extends Controller
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
     * Lists all MaterialProperties models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new modelsMaterialPropertiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaterialProperties model.
     * @param string $id ID del material
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
     * Creates a new MaterialProperties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MaterialProperties();

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
     * Updates an existing MaterialProperties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID del material
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
     * Deletes an existing MaterialProperties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID del material
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
     * Finds the MaterialProperties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID del material
     * @param string $property ID de la propiedad
     * @return MaterialProperties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $property)
    {
        if (($model = MaterialProperties::findOne(['id' => $id, 'property' => $property])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

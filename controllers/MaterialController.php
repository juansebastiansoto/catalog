<?php

namespace app\controllers;

use app\models\Material;
use app\models\MaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialController implements the CRUD actions for Material model.
 */

use app\models\MaterialProperties;
use app\models\Model;

class MaterialController extends Controller
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
     * Lists all Material models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Material model.
     * @param string $id ID del Material
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Material();
        $modelProperties = [new MaterialProperties];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $modelProperties = Model::createMultiple(MaterialProperties::classname());
                Model::loadMultiple($modelProperties, $this->request->post());

                $model->name = $model->generateName($modelProperties);

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelProperties) && $valid;

                if ($valid) {

                    $transaction = \Yii::$app->db->beginTransaction();

                    if ($flag = $model->save(false)) {
                        foreach ($modelProperties as $property) {
                            $property->id = $model->id;
                            $property->property = \Yii::$app->myClass->guidv4();
                            if (!($flag = $property->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {

                    return $this->render('create', [
                        'model' => $model,
                        'modelProperties' => (empty($modelProperties)) ? [new MaterialProperties] : $modelProperties
                    ]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelProperties' => (empty($modelProperties)) ? [new MaterialProperties] : $modelProperties
        ]);
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID del Material
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProperties = [new MaterialProperties];

        $modelProperties = MaterialProperties::findall($model->id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $modelProperties = Model::createMultiple(MaterialProperties::classname());
                Model::loadMultiple($modelProperties, $this->request->post());

                $model->name = $model->generateName($modelProperties);

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelProperties) && $valid;

                if ($valid) {

                    $transaction = \Yii::$app->db->beginTransaction();

                    if ($flag = $model->save(false)) {
                        MaterialProperties::deleteAll(['id' => $model->id]);
                        foreach ($modelProperties as $property) {
                            $property->id = $model->id;
                            $property->property = \Yii::$app->myClass->guidv4();
                            if (!($flag = $property->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {

                    return $this->render('create', [
                        'model' => $model,
                        'modelProperties' => (empty($modelProperties)) ? [new MaterialProperties] : $modelProperties
                    ]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelProperties' => (empty($modelProperties)) ? [new MaterialProperties] : $modelProperties
        ]);
    }

    /**
     * Deletes an existing Material model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID del Material
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID del Material
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Material::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use app\models\Template;
use app\models\TemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\TemplateProperties;
use app\models\Model;


/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
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
     * Lists all Template models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TemplateSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Template model.
     * @param string $id ID del template
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
     * Creates a new Template model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Template();
        $modelProperties = [new TemplateProperties];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $modelProperties = Model::createMultiple(TemplateProperties::classname());
                Model::loadMultiple($modelProperties, $this->request->post());
    
                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelProperties) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
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
                        
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                } else {
                    return $this->render('create', [
                                'model' => $model,
                                'modelsBillPos' => (empty($modelProperties)) ? [new TemplateProperties] : $modelProperties
                    ]);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelProperties' => (empty($modelProperties)) ? [new TemplateProperties] : $modelProperties
        ]);
    }

    /**
     * Updates an existing Template model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID del template
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Template model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID del template
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Template model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID del template
     * @return Template the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Template::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace wo\settings\controllers;

use Yii;
use wo\settings\models\Settings;
use wo\settings\models\SettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class ManagerController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'delete' => ['bulk-delete']
                ],
            ],
        ];
    }

    public function actionIndex()
    {    
        $searchModel = new SettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Settings();
        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return ['forceClose'=>true,'forceReload'=>true];         
    }

    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks');
        foreach (Settings::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['forceClose'=>true,'forceReload'=>true]; 
    }

    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

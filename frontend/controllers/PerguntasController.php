<?php

namespace frontend\controllers;

use Yii;
use app\models\Perguntas;
use app\models\PerguntasSearch;
use app\models\Respostas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\Materias;

/**
 * PerguntasController implements the CRUD actions for Perguntas model.
 */
class PerguntasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Perguntas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PerguntasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $dataProvider->pagination = [
        //     'pageSize' => 2,
        // ];

        $materia = Materias::getDataList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'materia' => $materia
        ]);
    }

    /**
     * Displays a single Perguntas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $createAnswer = new Respostas();
        $post = \Yii::$app->request->post();
        if ($createAnswer->load(Yii::$app->request->post()) && $createAnswer->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Pergunta respondida com sucesso!');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'answer' => $createAnswer,
        ]);
    }

    public function actionMyquestions()
    {
        $model = Perguntas::getMyQuestions();

        return $this->render('minhas', [
            'model' => $model
        ]);
    }
    /**
     * Creates a new Perguntas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Perguntas();
        $materia = Materias::getDataList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'materia' => $materia
        ]);
    }

    /**
     * Updates an existing Perguntas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Perguntas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Perguntas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Perguntas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Perguntas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

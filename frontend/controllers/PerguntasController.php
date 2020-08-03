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
use Symfony\Component\BrowserKit\Cookie;
use yii\web\Cookie as WebCookie;
use yii\web\Session;

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
        // $query = Perguntas::find();
        // $countQuery = clone $query;
        // $pages = new Pagination(['totalCount' => $countQuery->count()]);
        // $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        // return $this->render('index', ['models' => $models,'pages' => $pages]);

        $searchModel = new PerguntasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;

        $materia = Materias::getDataList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'materia' => $materia,
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
        if ($createAnswer->load(Yii::$app->request->post()) && $createAnswer->save()) {
            // \Yii::$app->getSession()->setFlash('success', 'Pergunta respondida com sucesso!');
            // return 1;
        }
        $hasBatter = Respostas::hasBatter($id);
        if($hasBatter){
            $orderBy = [
                'is_best' => SORT_DESC,
                'is_likeable' => SORT_DESC,
            ];
        }else{
            $orderBy = ['is_likeable' => SORT_DESC];
        }
        $resposta = Respostas::find()
            ->where('perguntas_id = ' .$id)
            ->orderBy($orderBy)
            ->all();


        return $this->render('view', [
            'resposta' => $resposta,
            'model' => $this->findModel($id),
            'answer' => $createAnswer,
            'hasBatter' => $hasBatter,
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

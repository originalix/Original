<?php

namespace backend\controllers;

use Yii;
use common\models\SlideShow;
use backend\models\SlideShowSearch;
use backend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AddSlideShowForm;
use yii\web\UploadedFile;
use backend\models\ChangeSlideShow;

/**
 * SlideshowController implements the CRUD actions for SlideShow model.
 */
class SlideshowController extends BaseController
{
    /**
     * @inheritdoc
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
     * Lists all SlideShow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlideShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SlideShow model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SlideShow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddSlideShowForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile  = UploadedFile::getInstance($model, 'imageFile');
            
            if ($slideshow = $model->saveSlideShow()) {
                return $this->redirect(['view', 'id' => $slideshow->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * 调整首页轮播图的使用
     *
     * @return void
     */
    public function actionChange()
    {
        $models = SlideShow::find()->all();

        if (Yii::$app->request->isPost) {
            $session = Yii::$app->session;
            $idArr = [];
            $selectedId = Yii::$app->request->post('id');
            
            if (count($selectedId) > 3) {
                $session->setFlash('error', '最多选择三个轮播图');
            }

            
            $is_usage_models = SlideShow::find()
            ->where(['is_usage' => 1])
            ->all();
            
            foreach ($is_usage_models as $model) {
                $model->is_usage = 0;
                $model->save();
            }

            foreach($selectedId as $id) {
                $model = SlideShow::findOne($id);
                $model->is_usage = 1;
                $model->save();
            }

            return $this->redirect('index');
    
        }
        return $this->render('change', [
            'data' => $models,
        ]);
    }

    /**
     * Updates an existing SlideShow model.
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
     * Deletes an existing SlideShow model.
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
     * Finds the SlideShow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SlideShow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SlideShow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php 
namespace kriptograf\menu\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use kriptograf\menu\models\Menu;
use kriptograf\menu\models\MenuItem;

class ItemsController extends \yii\web\Controller
{
    /**
     * List items from menu
     * @param $id integer - identifier menu
     * @return mixed
     */
	public function actionIndex($id)
	{
		$query = MenuItem::find()->where(['menu_id'=>$id, 'parent_id'=>0]);
		$dataProvider = new ActiveDataProvider([
			'query'=>$query
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'id'=>$id
		]);
	}

	/**
	 * Create menu item
     * Redurect to list items
	 * @return string|Response
	 */
	public function actionCreate($id)
	{
		$model = new MenuItem();

        if ($model->load(Yii::$app->request->post()))
        {
			$model->menu_id = $id;

            if($model->save())
			{
				return $this->redirect(['index', 'id' => $model->menu_id]);
			}
        }
        return $this->render('create', ['model' => $model, 'id'=>$id]);
	}

	/**
	 * 
	 * @param $id
	 * @return array|string
	 */
	public function actionView($id)
	{
		$model = Menu::findOne($id);
		$request = Yii::$app->request;
	
		 if ($request->isAjax)
		 {
			\Yii::$app->response->format = Response::FORMAT_JSON;

			switch (true) {
				case $request->post('get'):
					return ['success' => true, 'menu' => $model->menu];
				default:
					return ['success' => false];
			}
		}

		return $this->render('view', ['model' => $model]);
	}

	/**
     * Edit item menu
	 * @param $id
	 * @return array|string
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()))
		{
			$model->menu_id = $id;

			if($model->save())
			{
				return $this->redirect(['index', 'id' => $model->menu_id]);
			}
		}
	
		return $this->render('update', ['model'=>$model, 'id'=>$model->menu_id]);
	}

	/**
	 * @param $id
	 * @return Response
	 * @throws NotFoundHttpException
	 * @throws \Exception
	 * @throws \Throwable
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(Yii::$app->request->referrer);
	}

	/**
	 * @param $id
	 * @return static
	 * @throws NotFoundHttpException
	 */
    protected function findModel($id)
	{
	    if (($model = MenuItem::findOne($id)) !== null) {
		    return $model;
	    } else {
		    throw new NotFoundHttpException('The requested menu does not exist.');
	    }
    }




}

<?php

namespace kriptograf\menu\controllers;

use kriptograf\menu\models\Menu;
use kriptograf\menu\models\Search;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Creator Menu Controller
 *
 *
 * @package kriptograf\menu\controllers
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class CreatorController extends Controller
{
    /**
     * Main page management menus
     *
     * @return string
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionIndex(): string
    {
        /** @var Search $searchModel */
        $searchModel  = new Search();

        /** @var \yii\data\ActiveDataProvider $dataProvider */
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create menu
     *
     * @return string|Response
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionCreate()
    {
        /** @var Menu $model */
        $model = new Menu();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * View list items from this menu
     * Redirect to controller Items
     *
     * @param integer $id
     *
     * @return array|string
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionView(int $id)
    {
        return $this->redirect([
            '/menu/items/index',
            'id' => $id,
        ]);
    }

    /**
     * Edit menu
     *
     * @param integer $id
     *
     * @return array|string
     * @throws NotFoundHttpException
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Delete item from menu
     *
     * @param integer $id
     *
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Internal method find menu by id
     *
     * @param integer $id
     *
     * @return Menu
     * @throws NotFoundHttpException
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    protected function findModel(int $id): Menu
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested menu does not exist.');
        }
    }

}

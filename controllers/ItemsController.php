<?php

namespace kriptograf\menu\controllers;

use kriptograf\menu\models\Menu;
use kriptograf\menu\models\MenuItem;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Items Menu Controller
 *
 *
 * @package kriptograf\menu\controllers
 *
 * @author Виталий Москвин <foreach@mail.ru>
 */
class ItemsController extends Controller
{
    /**
     * List items from menu
     *
     * @param integer $id identifier menu
     *
     * @return mixed
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionIndex(int $id)
    {
        /** @var yii\db\ActiveQuery $query */
        $query        = MenuItem::find()->where([
            'menu_id'   => $id,
            'parent_id' => 0,
        ]);

        /** @var ActiveDataProvider $dataProvider */
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id'           => $id,
        ]);
    }

    /**
     * Create menu item
     * Redirect to list items
     *
     * @param integer $id
     *
     * @return string|Response
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionCreate(int $id)
    {
        /** @var MenuItem $model */
        $model = new MenuItem();

        if ($model->load(Yii::$app->request->post())) {
            $model->menu_id = $id;

            if ($model->save()) {
                return $this->redirect([
                    'index',
                    'id' => $model->menu_id,
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'id'    => $id,
        ]);
    }

    /**
     * View menu item
     *
     * @param integer $id
     *
     * @return array|string
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public function actionView(int $id)
    {
        /** @var Menu $model */
        $model   = Menu::findOne($id);

        $request = Yii::$app->request;

        if ($request->isAjax) {
            // -- Set response format as JSON
            Yii::$app->response->format = Response::FORMAT_JSON;

            switch (true) {
                case $request->post('get'):
                    return [
                        'success' => true,
                        'menu'    => $model->menu,
                    ];
                default:
                    return ['success' => false];
            }
        }

        return $this->render('view', ['model' => $model]);
    }

    /**
     * Edit item menu
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
                return $this->redirect([
                    'index',
                    'id' => $model->menu_id,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'id'    => $model->menu_id,
        ]);
    }

    /**
     * Delete menu item
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
     * Find menu item by id
     *
     * @param integer $id
     *
     * @return MenuItem
     * @throws NotFoundHttpException
     *
     * @author Виталий Москвин <foreach@mail.ru>
     */
    protected function findModel(int $id): MenuItem
    {
        if (($model = MenuItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested menu does not exist.');
        }
    }

}

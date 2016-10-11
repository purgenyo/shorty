<?php
/**
 * Created by PhpStorm.
 * User: purgen
 * Date: 10.10.16
 * Time: 21:38
 */

namespace app\controllers;


use app\models\Links;
use Yii;
use yii\rest\ActiveController;
use yii\web\Link;
use yii\web\Response;

class ShortController extends ActiveController
{
    public $modelClass = 'app\models\Links';

    /**
     *
     * add json formatter
     *
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'text/html' => Response::FORMAT_JSON,
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
        ];
        $behaviors['corsFilter'] = [
            'class' => 'yii\filters\Cors',
        ];
        return $behaviors;
    }

    /**
     *
     * unset default actions
     *
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @return array
     */
    public function actionCreate() {

        //get post
        $post_model = Yii::$app->request->post('Links', false);

        if(isset($post_model['full_address'])) {

            $hash = Links::generateHash($post_model['full_address']);
            $model = Links::find()->where(['link_hash'=>$hash])->one();

            if(empty($model)){
                //if empty: create
                $model = new Links;
                $model->load(Yii::$app->request->post());
                $model->link_hash = $hash;

                if(!$model->save()){
                    return ['success'=>0, 'errors'=>$model->getErrors()];
                }
            }
            // return old or new data
            return [
                'success'=>1,
                'url'=>Yii::$app->urlManager->createAbsoluteUrl(['site/index', 'url'=>$model->link_hash])
            ];
        } else {
            return ['success'=>0, 'errors'=>['Пустой запрос']];
        }
    }
}
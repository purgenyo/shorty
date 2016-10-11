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

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['delete']);
        return $actions;
    }


    public function actionCreate() {

        $post_model = Yii::$app->request->post('Links');
        if(isset($post_model['full_address'])) {
            $hash = Links::generateHash($post_model['full_address']);
            $model = Links::find()->where(['link_hash'=>$hash])->one();

            if(empty($link)){
                $model = new Links;
                $model->load(Yii::$app->request->post());
                $model->link_hash = $hash;

                if(!$model->save()){
                    return ['success'=>0, 'errors'=>$model->getErrors()];
                }
            }

            return [
                'success'=>1,
                'url'=>Yii::$app->urlManager->createAbsoluteUrl(['site/index', 'url'=>$model->link_hash])
            ];

        } else {
            return ['success'=>0, 'errors'=>['Пустой запрос']];
        }
    }

}
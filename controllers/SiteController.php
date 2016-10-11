<?php

namespace app\controllers;

use app\models\Links;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays main page content.
     *
     * @return string
     */
    public function actionIndex( $url = false )
    {   
        $request = Yii::$app->request;

        if($url){
            $link = Links::getFullLinkByHash($url);
            if($link){
                $this->redirect($link->full_address);
                Yii::$app->end();
            }
            $this->redirect('/');
        }

        return $this->render('index');
    }
}

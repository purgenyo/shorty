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
        if($url){
            $link = Links::getFullLinkByHash($url);
            if($link){
                if (!empty($link->full_address)) {
                    $this->redirect($link->full_address);
                }
                Yii::$app->end();
            }
            $this->redirect('/');
        }
        //if url empty, render main page
        return $this->render('index');
    }
}

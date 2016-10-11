<?php

namespace app\controllers;

use app\models\Links;
use Yii;
use yii\web\Controller;

/**
 * Class SiteController
 * @package app\controllers
 */
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
            $this->redirect(Links::getFullLinkByHash($url));
        }
        //if url empty, render main page
        return $this->render('index');
    }
}

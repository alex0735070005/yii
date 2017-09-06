<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Cities;

class CitiesController extends Controller
{
    public function actionIndex()
    {
       
        $model = new Cities();
        
        $data = $model->getCities();
        
        return $this->render('index', [
            'cities'         => $data['cities'],
            'pagination'    => $data['pagination'],
        ]);
    }
    
    public function actionAge()
    {
       
        $model = new Cities();
        
        $data = $model->getAge();
        
        return $this->render('age', [
            'cities'         => $data['cities'],
            'pagination'    => $data['pagination'],
        ]);
    }
}
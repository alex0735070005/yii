<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Phones;
use yii\data\Pagination;

class PhonesController extends Controller
{
    public function actionIndex()
    {
        $query = Phones::find()
                ->from('phones p')
                ->Where('MONTH(p.created_at) >= 4 AND  MONTH(p.created_at) <= 9 AND YEAR(p.created_at) = 2015');
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
        $phones = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
        
        return $this->render('index', [
            'phones' => $phones,
            'pagination' => $pagination
        ]);
    }
    
    
}
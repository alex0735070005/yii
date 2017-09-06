<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Staff;
use app\models\Cities;

class StaffController extends Controller
{
    public function actionIndex()
    {
        $Staff = new Staff();
        $data = $Staff->getDataStaff();
        
        $model = new Cities();
        $cities = $model->getDataCities();
        
        return $this->render('index', [
            'id'            => 0,
            'staff'         => $data['staff'],
            'cities'        => $cities,
            'pagination'    => $data['pagination'],
        ]);
    }
    
    
    public function actionStaffCity($id = 0)
    {
        if($id == 0){
            return $this->redirect(['staff/index']);
        }
        
        $Staff = new Staff();
        $data = $Staff->getDataStaffCity($id);
         
        $model = new Cities();        
        $cities = $model->getDataCities();
        
        return $this->render('index', [
            'id'            => $id,
            'staff'         => $data['staff'],
            'cities'        => $cities,
            'pagination'    => $data['pagination'],
        ]);
    }
    
    public function actionStaffMail($sort)
    {
        if($sort != 'phone_mail'){
            return $this->redirect(['staff/index']);
        }
        
        $Staff = new Staff();
        $data = $Staff->getDataStaffMail();
         
        $model = new Cities();        
        $cities = $model->getDataCities();
            
        return $this->render('index', [
            'id'            => 0,
            'staff'         => $data['staff'],
            'cities'        => $cities,
            'pagination'    => $data['pagination'],
        ]);
    }
    
    public function actionStaffPhones($sort)
    {
        if($sort != 'phones_date'){
            return $this->redirect(['staff/index']);
        }
        
        $Staff = new Staff();
        $data = $Staff->getDataStaffPhones();
         
        $model = new Cities();        
        $cities = $model->getDataCities();
            
        return $this->render('index', [
            'id'            => 0,
            'staff'         => $data['staff'],
            'cities'        => $cities,
            'pagination'    => $data['pagination'],
        ]);
    }
    
    public function actionStaffAge($sort)
    {
        if($sort != 'phones_date'){
            return $this->redirect(['staff/index']);
        }
        
        $Staff = new Staff();
        $data = $Staff->getDataStaffPhones();
         
        $model = new Cities();        
        $cities = $model->getDataCities();
            
        return $this->render('index', [
            'id'            => 0,
            'staff'         => $data['staff'],
            'cities'        => $cities,
            'pagination'    => $data['pagination'],
        ]);
    }
    
    
}
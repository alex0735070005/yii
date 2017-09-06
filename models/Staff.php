<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\Pagination;
use DateTime;

class Staff extends ActiveRecord
{
    
    public function getPhones()
    {
        return $this->hasMany(Phones::className(), ['id' => 'phones__id'])
            ->viaTable('staff_phones', ['staff__id' => 'id']);
    }
    
    public function getEmails()
    {
        return $this->hasMany(Emails::className(), ['id' => 'emails__id'])
            ->viaTable('staff_emails', ['staff__id' => 'id']);
    }
    
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['id' => 'cities__id'])
            ->viaTable('staff_cities', ['staff__id' => 'id']);
    }
    
    public function getAge(){
        $datetime = new DateTime($this->date_of_birth);
        $interval = $datetime->diff(new DateTime(date("Y-m-d")));
        return $interval->format("%Y");
    }
    
    public function getDataStaff()
    {
        $query = $this->find();
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
         $staff = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
         
         return array('staff'=> $staff, 'pagination'=>$pagination);
    }
    
    public function getDataStaffCity($id)
    {
        $query = $this->find()
                ->leftJoin('staff_cities', 'staff_cities.staff__id = staff.id')
                ->leftJoin('cities', 'staff_cities.cities__id = cities.id')
                ->where(['cities.id' => $id]);
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
         $staff = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
         
         return array('staff'=> $staff, 'pagination'=>$pagination);
    }
    
    public function getDataStaffMail()
    {
        $sql = '(
                    SELECT
                      COUNT( id )
                    FROM staff_phones spp WHERE  spp.staff__id = sf.id
                ) > 1';
        
        $query = $this->find()
                ->from('staff sf') 
                ->leftJoin('staff_emails se', 'se.staff__id = sf.id')
                ->leftJoin('emails e', 'se.emails__id = e.id')
                ->Where(['like', 'e.name', '.com'])
                ->andWhere($sql);
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
        $staff = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
        
        return array('staff'=> $staff, 'pagination'=>$pagination);
    }
    
    public function getDataStaffPhones()
    {
        $query = $this->find()
                ->from('staff sf') 
                ->leftJoin('staff_phones ph', 'ph.staff__id = sf.id')
                ->leftJoin('phones p', 'ph.phones__id = p.id')
                ->Where('(p.updated_at - p.created_at) = 0');
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
        $staff = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
        
        return array('staff'=> $staff, 'pagination'=>$pagination);
    }
    
}
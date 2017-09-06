<?php

namespace app\models;
use yii\data\Pagination;
use yii\db\ActiveRecord;


class Cities extends ActiveRecord
{
    public $count_staff;
    public $count_age;
    
    public function getCities()
    {
        $select_sql = 'c.name, (SELECT COUNT(sc.staff__id) FROM staff_cities sc 
            LEFT JOIN staff s ON (sc.staff__id = s.id) WHERE  s.created_at < DATE_SUB(NOW(), INTERVAL 1 MONTH)
            AND TIMESTAMPDIFF(YEAR,s.date_of_birth, CURDATE() ) > 30 AND sc.cities__id = c.id) as count_staff';
        
        $query = $this->find()
                ->select($select_sql)
                ->from('cities c');
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
         $cities = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
         
         return array('cities'=> $cities, 'pagination'=>$pagination);
    }
    
    public function getDataCities()
    {
        $connection = \Yii::$app->db;
        
        $model = $connection->createCommand('SELECT c.id, c.name FROM cities c');
        
        return $model->queryAll();
    }
    
    public function getAge()
    {
        $select_sql = 'name, (SELECT ROUND((SUM(TIMESTAMPDIFF(YEAR,sf.date_of_birth, CURDATE() ))/  COUNT(sf.id)), 0)  FROM'
                . ' staff sf LEFT JOIN staff_cities sc ON (sf.id = sc.staff__id) WHERE sc.cities__id = c.id AND sf.status = 0) as count_age';
        
        $query = $this->find()
                ->select($select_sql)
                ->from('cities c');
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        
         $cities = $query->orderBy('name')->offset($pagination->offset)
            ->limit($pagination->limit)->all();
         
         return array('cities'=> $cities, 'pagination'=>$pagination);
    }
    
}
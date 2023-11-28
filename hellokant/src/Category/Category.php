<?php

namespace iutnc\hellokant\Category;

use iutnc\hellokant\model\Model;
use iutnc\hellokant\query\Query;

class Category extends Model{

    protected static $table='article';
    protected static $idColumn='id';

    public static function belongs_to(){

    }

    public static function has_many(){
        
    }
}
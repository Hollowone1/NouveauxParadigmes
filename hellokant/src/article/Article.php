<?php

namespace iutnc\hellokant\article;

use iutnc\hellokant\model\Model;
use iutnc\hellokant\query\Query;


class Article extends Model {
    protected static $table='article';
    protected static $idColumn='id';
    
    public static function all() : array {    
        $all = Query::table(static::$table)->get();    
        $return=[];    
        foreach( $all as $m) {        
            $return[] = new static($m);    
        }    
        return $return; }

        public static function find(int $id): Model {   
            $row=Query::table(static::$table)
            ->where(static::$idColumn, '=', $id)->get();    
            return new static($row); }

        public static function first(int $id): Model {   
             $row=Query::table(static::$table)
             ->where(static::$idColumn, '=', $id)->one();    
             return new static($row); }
    
}

$a = new Article(); 
$a->nom = 'velo';  
$a->tarif=273; 
$a->Query::insert(); 
print $a->id ; 
$liste -> Article::all(); 
foreach( $liste as $article) { 
    print $article->nom; 
}
/*$a = new Article(); $a->nom = 'velo'; $a->tarif=273;
$a->Query::insert();
$a->Query::get();

foreach( $liste as $article) {
print $article->nom;
}

Query::table('article')
->where('id','=',5);
->delete();*/
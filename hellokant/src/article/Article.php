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
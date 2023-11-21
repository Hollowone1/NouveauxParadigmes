<?php

use hellokant\src\Model\Model; 
use iutnc\hellokant\query\Query;

class Article extends \hellokant\src\model\Model {
    protected static $table='article';
    protected static $idColumn='id';
    
}

$a = new Article(); $a->nom = 'velo'; $a->tarif=273;
$a->Query::insert();
$a->Query::get();

foreach( $liste as $article) {
print $article->nom;
}

Query::table('article')
->where('id','=',5);
->delete();
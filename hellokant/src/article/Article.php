<?php

namespace iutnc\hellokant\article;

use iutnc\hellokant\model\Model;
use iutnc\hellokant\query\Query;

class Article extends Model {
    protected static $table='article';
    protected static $idColumn='id';
    
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
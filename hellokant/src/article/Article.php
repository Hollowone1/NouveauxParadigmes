<?php

namespace iutnc\hellokant\article;

use iutnc\hellokant\model\Model;
use iutnc\hellokant\query\Query;
use iutnc\hellokant\connection\ConnectionFactory;

class Article extends Model {
    protected static $table='article';
    protected static $idColumn='id';
    
    public function all() {
        $pdo = ConnectionFactory::getConnection();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        return $stmt->fetchAll();
    }
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
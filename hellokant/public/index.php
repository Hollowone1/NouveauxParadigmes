<?php

require '../vendor/autoload.php';

use \iutnc\hellokant\query\Query;
use \iutnc\hellokant\connection\ConnectionFactory;
use \iutnc\hellokant\article\Article;


// une seule fois au lancement de l'application
$conf = parse_ini_file('../config/db.conf.ini') ;
ConnectionFactory::makeConnection($conf);

$a = new Article();
$a->nom = 'velo';
$a->tarif= '12';
$a->id_categ = '1';
$a->descr = 'beau petit velo';

var_dump($a);

/*$q = Query::table('article');
$q->select(['nom']);
$q->where('id', '=', 64);
$q->get();
var_dump($q->get());*/

//$insert = Query::table('article')->insert(['nom'=>'grovelo', 'tarif'=>200, 'id_categ'=>1]);
//var_dump($insert);

//$qd = Query::table('article')->where('id', '=', 109);
//$qd->delete();

////tests
//$db = new \PDO('mysql:host=td.article.db;dbname=article', 'article', 'article');
//// use the connection here
//$stmt = $db->prepare('delete from article where id = 118');
//$stmt->execute();
//var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));



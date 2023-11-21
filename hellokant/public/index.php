<?php
echo "bonjour";


//tests
$db = new \PDO('mysql:host=td.article.db;dbname=article', 'article', 'article');
// use the connection here
$stmt = $db->prepare('SELECT * FROM article');
$stmt->execute();
var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));


<?php

namespace iutnc\hellokant\query;
use iutnc\hellokant\connection\ConnectionFactory;

class Query {
    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql = '';

    private function __construct( string $table) {
        $this->sqltable=$table;
    }

    public static function table(string $table) : Query {
        $query = new Query($table);
        return $query;
    }

    public function where(string $col, string $op, mixed $val) : Query
    {
        if(!is_null($this->where)) {
            $this->where .= ' and ';
        }
        //retourne un objet Query, donc on pourra appeler autre méthode après (notamment get())
        $this->where .= ' ' . $col . ' ' . $op . ' ? ';
        $this->args[]=$val;


        return $this;
    }


    public function get() : array  {
        $pdo = ConnectionFactory::getConnection();
        //$pdo= new \PDO('dsn', 'user', 'pass');
        $this->sql  = 'select '. $this->fields . ' from ' . $this->sqltable;
        if (!is_null($this->where)) {
            $this->sql .= ' where ' . $this->where;
        }
        //prepare puis execute avec arguments
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        //var_dump($this->sql);
        //var_dump($this->args);
        //var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function insert(array $t) : int {
        $into = array_keys($t);
        $values = array_fill(0, count($t), '?');
        $this->args = array_values($t);

        $this->sql = 'insert into ' . $this->sqltable;
        $this->sql .= ' (' . implode(',', $into) . ') '.'values ('. implode(',', $values).')';
//        foreach ($t as $attname => $attval) {
//            $into[] = $attname;
//            $values[] = '?';
//            $this->args[] = $attval;
//        }

        //$pdo = new \PDO('mysql:host=td.article.db;dbname=article', 'article', 'article');
        //on va chercher connexion (seulement si elle a été créée avant)
        $pdo = ConnectionFactory::getConnection();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);

        return (int)$pdo->lastInsertId($this->sqltable);

        //var_dump($this->sql);
        //var_dump($this->args);
    }

    public function select( array $fields) : Query {
        $this->fields = implode(',', $fields);
        return $this;
    }

    public function delete() : bool{

        //$delete = array_keys($t);
        //$values = array_fill(0, count($t), '?');
        //$this->args = array_values($t);
        //var_dump($this->where);
        $this->sql = 'delete from ' . $this->sqltable;
        if (!is_null($this->where)) {
            $this->sql .= ' where ' . $this->where;
        }

        $pdo = ConnectionFactory::getConnection();
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        return true;
    }
}
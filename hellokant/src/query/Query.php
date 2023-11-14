<?php

namespace iutnc\hellokant\query;

class Query {
    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql = '';

    public static function table(string $table) : Query {
        $query = new Query;
        $query->sqltable= $table;
        return $query;
    }

    public function where(string $col, string $op, mixed $val) : Query
    {
        //retourne un objet Query, donc on pourra appeler autre méthode après (notamment get())
        $this->where = $col . $op . '?';
        $this->args[]=$val;
        return $this;
    }


    public function get() : Array  {
        $pdo= new \PDO('dsn', 'user', 'pass');
        $this->sql  = 'select '. $this->fields .
            ' from ' . $this->sqltable;
        if ($this->where) {
            $this->sql .= ' where ' . $this->where;
        }
        //prepare puis execute avec arguments
        $stmt = $pdo->prepare($this->sql);
        $stmt->execute($this->args);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
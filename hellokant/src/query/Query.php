<?php

namespace iutnc\hellokant\query;

class Query {
    private $sqltable;
    private $fields = '*';
    private $where = null;
    private $args = [];
    private $sql = '';

    public static function table( string $table) : Query {
        $query = new Query; $query->sqltable= $table; return $query;
    }
}
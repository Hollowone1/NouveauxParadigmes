<?php

    namespace iutnc\hellokant\model;
    use iutnc\hellokant\connection\ConnectionFactory;

    class Model {
        protected static $table;
        protected static $idColumn = 'id';
        protected $atts = [];
            
        public function __construct(array $t = null) {
        if (!is_null($t)) $this->_atts = $t;
        }

        public function __get(string $name) : mixed {
        if (array_key_exists($name, $this->_atts)) {
            return $this->_atts[$name];
        }
        return $this;
        }

        public function __set(string $name, mixed $val) : void {
        $this->atts[$name] = $val;
        }

        public function delete() : bool {
            $this->sql = 'delete from'. $this->sqltable;
            if(!is_null($this->where))
                $this->sql .= ' where '. $this->where;

            $pdo= ConnectionFactory::getConnection();

            $stmt = $pdo->prepare($this->sql);
            return $stmt->execute($this->args);

            var_dump($this->sql);
            var_dump($this->args);
            return true;
        }
    }
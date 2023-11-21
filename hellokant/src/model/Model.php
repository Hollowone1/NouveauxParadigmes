<?php

namespace iutnc\hellokant\model;
use iutnc\hellokant\connection\ConnectionFactory;
use iutnc\hellokant\query\Query;


abstract class Model {
    protected static $table;
    protected static $idColumn = 'id';
    protected $atts = [];
    protected static $query;
            
        public function __construct(array $t = null) {
            if (!is_null($t)) {
             $this->_atts = $t;
            }
        }

        public function __get(string $name) : mixed {
            if (array_key_exists($name, $this->_atts)) {
                return $this->_atts[$name];
            }
            if (method_exists($this, $name)) {
                return $this->$name();
            }
            $emess = get_class($this) . ": unknown attribute $name (getAttr)";
            //throw new \ModelException($emess, 45);
            throw new \ModelException($emess, 45);

        }

        public function __set(string $name, $val) : void {
            $this->atts[$name] = $val;
        }

        public function delete() {
            $oid = isset($this->_atts[static::$idColumn]) ? $this->_atts[static::$idColumn] : null;
            if (is_null($oid)) {
                //throw new \ModelException(get_called_class() . "Primary Key undefined : cannot delete");
                throw new \ModelException(get_called_class() . "Primary Key undefined : cannot delete");
            }
            static::$query = Query::table(static::$table)->where(static::$idColumn, '=', $oid);
            return static::$query->delete();

        }

        public static function one(int $id) : Model {
            static::$query = Query::table(static::$table);
            $row = static::$query->where(static::$idColumn, '=', $id)->one();
            return new static($row);
        }
    }
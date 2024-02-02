<?php

namespace iutnc\hellokant\Category;

use iutnc\hellokant\model\Model;
use iutnc\hellokant\query\Query;
use iutnc\hellokant\model\ModelException;

class Category extends Model{

    protected static $table='article';
    protected static $idColumn='id';

    public function belongs_to($modelName, $foreignKey) {
        $foreignKeyValue = $this->{$foreignKey};

        $linkedModel = $modelName::first([$foreignKey => $foreignKeyValue]);

        return $linkedModel;
    }


    public function has_many($modelName, $foreignKey) {
        $primaryKeyValue = $this->id;

        $linkedModels = $modelName::find([$foreignKey => $primaryKeyValue]);

        return $linkedModels;
    }

    public function categorie() {
        return $this->belongs_to('Categorie', 'id_categ');
    }

    public function articles() {
        return $this->has_many('Article', 'id_categ');
    }

    public function __get($name) {
        if ($name == 'articles') {
            return $this->has_many('Article', 'id_categ');
        }

        throw new \ModelException("Propriété non définie : $name");
    }
}
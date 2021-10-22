<?php

namespace MVC\Core;

abstract class DbModel extends Model
{
    abstract public function tableName() :string ;
    
    abstract public function attributes() :array;

    abstract public function primaryKey() : string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("
            INSERT INTO $tableName (". implode(',', $attributes) .")
            VALUES(".implode(',', $params) .");
        ");

        // var_dump($statement, $params, $attributes);
        // exit;

        foreach ($attributes as $attribute) {
            # code...
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        var_dump($tableName);
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value) {
            # code...
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
        # code...
    }
}
<?php

namespace app\database\models;

use app\database\Connection;
use PDO;

abstract class Model
{
  protected string $table;
  private array $attributes = [];

  public function __set($key, $value)
  {
    if (!isset($this->attributes[$key])) {
      $this->attributes[$key] = $value;
    }
  }

  public function __get($key)
  {
    return $this->attributes[$key];
  }

  public function toJson(array $fields = [])
  {
    $attributes = [];

    if (!empty($fields)) {
      foreach ($fields as $field) {
        $attributes[$field] = $this->attributes[$field];
      }
    } else {
      $attributes = $this->attributes;
    }

    return json_encode($attributes);
  }

  public function all(string $fields = '*')
  {
    try {
      $connection = Connection::getConnection();
      $sql = "select {$fields} from {$this->table}";
      $query = $connection->query($sql);
      return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    } catch (\PDOException $e) {
      //throw $th;
      var_dump($e->getMessage());
    }
  }
}

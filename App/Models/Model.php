<?php
include "../Database/Database.php";
use App\Database\Database;
class Model extends Database
{
    public static function all()
    {
        $sql = "SELECT * FROM " . static::$table;
        $query = self::connect()->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";
        $query = "INSERT INTO " . static::$table . " ({$columns})  VALUES ({$values})";
        $stmt = self::connect()->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public static function update(array $data, int $id)
    {
        $setParts = [];
        $params = [];

        foreach ($data as $key => $value) {
            $setParts[] = "{$key} = :{$key}";
            $params[":{$key}"] = $value;
        }

        $cleanedString = implode(", ", $setParts);

        $query = "UPDATE " . static::$table . " SET {$cleanedString} WHERE id = :id";

        $params[':id'] = $id;

        $stat = self::connect()->prepare($query);

        foreach ($params as $key => $value) {
            $stat->bindValue($key, $value);
        }

        return $stat->execute();
    }

    public static function delete(int $id)
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = {$id}";
        $stat = self::connect()->prepare($query);
        if ($stat->execute()) {
            header("location: index.php");
        } else {
            return false;
        }
    }
    public static function where($word)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE name LIKE :word OR price LIKE :word or quantity LIKE :word";
        $stmt = self::connect()->prepare($sql);
        
        $search = "%$word%";
        $stmt->bindParam(':word', $search);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}

<?php

abstract class Connection
{
    private static $connection;

    public static function getConnection() {
        try {
            self::$connection = new \PDO('mysql: host=' . getenv('DB_HOST') . '; dbname=' . getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
        } catch (PDOException $e){
            die ("Cannot connect to database.\n" . $e->getMessage());
        }

        return self::$connection;
    }
}

?>
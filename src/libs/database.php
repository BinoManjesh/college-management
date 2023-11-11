<?php

const DB_HOST = 'localhost';
const DB_NAME = 'college_management';
const DB_USER = 'root';
const DB_PASSWORD = '';

function database(): PDO {
    static $pdo;

    if (!$pdo) {
        $pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
            DB_USER,
            DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    return $pdo;
}

function make_query(string $sql, array $data, bool $need_fetch=false) : array | false {
    $statement = database()->prepare($sql);
    foreach ($data as $key => $value) {
        $statement->bindValue($key, $value);
    }
    $statement->execute();
    if ($need_fetch) {
        $temp = $statement->fetch();
        return $temp;
    } else {
        return null;
    }
}

<?php

const DB_HOST = 'localhost';
const DB_NAME = 'college_management';
const DB_USER = 'root';
const DB_PASSWORD = '';
const FILE_DIR = __DIR__ . '/../../files/';

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
        return false;
    }
}

function upload_file(string $input_name) : string {
    var_dump($_FILES);
    $file_name = time() . '-' . basename($_FILES[$input_name]['name']);
    $full_name = FILE_DIR . $file_name;
    print $full_name;
    move_uploaded_file($_FILES[$input_name]['tmp_name'], $full_name);
    return $file_name;
}

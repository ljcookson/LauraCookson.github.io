<?php
    $db_host = "localhost";
    $db_user = "ljc806";          //  your MySQL username
    $db_pwd = "MhBd04,";           //  your MySQL password
    $db_db = "ljc806";            //  your MySQL database (= your username)
    $chars = "utf8mb4";

    $attr = "mysql:host=$db_host;dbname=$db_db; charset=$chars";

    $options = [
        PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES          =>false
    ];
?>
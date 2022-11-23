<?php
    $db_host = "localhost";// "sql3.freemysqlhosting.net";
    $db_user = "ljc806";// "sql3511412";          //  your MySQL username
    $db_pwd = "MhBd04,";// "9laCW3xdTs";           //  your MySQL password
    $db_db = "ljc806"; // "sql3511412";           //  your MySQL database (= your username)
    $chars = "utf8mb4";

    $attr = "mysql:host=$db_host;dbname=$db_db; charset=$chars";

    $options = [
        PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES          =>false
    ];
?>
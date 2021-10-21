<?php

use MVC\Core\Application;

class m0001_initial
{
    public function up()
    {
        # code...
        $db = Application::$app->db;
        $SQL = "CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
        // echo "Applying Migration".PHP_EOL;
    }

    public function down()
    {
        # code...
        $db = Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
        // echo "Dowm Migration".PHP_EOL;
    }


}
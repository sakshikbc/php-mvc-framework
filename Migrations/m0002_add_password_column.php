<?php

use MVC\Core\Application;

class m0002_add_password_column
{
    public function up()
    {
        $db = Application::$app->db;
        // $SQL = "ALTER TABLE users ADD_COLUMN password VARCHAR(512) NOT NULL;";
        $db->pdo->exec("ALTER TABLE users
        ADD password varchar(255) NOT NULL");
        # code...
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "ALTER TABLE users
        DROP COLUMN password";
        $db->pdo->exec($SQL);
    }
}
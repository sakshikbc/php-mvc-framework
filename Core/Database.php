<?php

namespace MVC\Core;

use MVC\Core\Application;

class Database
{
    public \PDO $pdo;
    // This class will be singleton which means there will be only one instance 
    // through out the project
    /**
     * Class constructor.
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $username = $config['username'];
        $password = $config['password'];
        $this->pdo = new \PDO($dsn, $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // This line will throw the error and exceptions 
    }

    public function applyMigrations()
    {
        # code...
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/Migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        
        foreach ($toApplyMigrations as $migration) {
            # code...
            if($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying Migration $migration");
            $instance->up();
            $this->log("Applied Migration $migration");
            $newMigrations[] = $migration;
        }

        if(!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All Migrations are Appplied");
        }

    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
        $str
        ");
        $statement->execute();
    }

    public function createMigrationsTable()
    {
        # code...
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
        # code...
    }

    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - '. $message.PHP_EOL;
    }

}

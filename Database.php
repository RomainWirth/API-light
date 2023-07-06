<?php

class PhpPdo {
    // configuration
    private $host = 'localhost';
    private $user = 'postgres';
    private $pwd = 'password';
    private $db = 'apidb';

    // connection method
    protected function getConnection() {
        $dsn = 'pgsql:host='.$this->host.';port=5432;dbname='.$this->db.';';
        try {
            // make a database connection
            $pdo = new PDO(
                $dsn,
                $this->user,
                $this->pwd,
//                [
//                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//                ]
            );
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            if ($pdo) {
                echo 'Connection à la base de données : $db établie';
            }
            return $pdo;
        } catch (PDOException $error) {
            die('Erreur : '.$error -> getMessage());
        }
    }
}

$phpPdo = new PhpPdo();
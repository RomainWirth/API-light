<?php

class Database {
    // configuration
    private $_host = 'localhost';
    private $_user = 'postgres';
    private $_pwd = 'password';
    private $_db = 'postgres';
    private $_port = 5432;
    public $_pdo;

    // connection method
    public function getConnection() {
        $dsn = 'pgsql:host='.$this->_host.';port='.$this->_port.';dbname='.$this->_db.';';
        try {
            // make a database connection
            $this->_pdo = new PDO(
                $dsn,
                $this->_user,
                $this->_pwd,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
//            $this->_pdo->exec("set names utf8");
            echo 'Connection à la base de données : ' . $this->_db . ' établie';

        } catch (PDOException $error) {
            echo ('Erreur : '.$error -> getMessage());
        }
        return $this->_pdo;
    }
}
<?php

class Employee {

    // Connexion
    private $_pdoConnection;

    // Propriétés
    private $_id;
    private $_name;
    private $_email;
    private $_age;
    private $_designation;
    private $_hiringDate;

    // constructeur = permet l'instanciation d'une connexion PDO
    public function __construct($_db){
        $this->_pdoConnection = $_db;
    }


    // crée un employé
    public function createEmployee() {
        $sql = "INSERT INTO employee (".$this->_name.","
            .$this->_email.","
            .$this->_age.","
            .$this->_designation.","
            .$this->_hiringDate.") 
            VALUES (?, ?, ?, ?, ?)";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute;
    }
    // récupère la liste de tous les employés
    public function getEmployees() {
        $sql = "SELECT id, name, email, age, designation, hiring_date FROM employee;";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute();
        var_dump($query);
        return $query;
    }
    // récupère un employé par son ID
    public function getEmployee() {
        $sql = "SELECT id, name, email, age, designation, hiring_date FROM employee WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute;
        return $query;
    }
    // update un employé
    public function updateEmployee() {
        $sql = "UPDATE employee SET name = ?, email = ?, age = ?, designation = ?, hiring_date = ? WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute;
        return $query;
    }
    // supprime un employé
    public function deleteEmployee() {
        $sql = "DELETE FROM employee WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute;
        return $query;
    }
}
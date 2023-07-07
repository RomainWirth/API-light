<?php

class Employee {

    // Connexion
    private $_pdoConnection;

    // Propriétés
    public $_id;
    public $_name;
    public $_email;
    public $_age;
    public $_designation;
    public $_hiringDate;

    // constructeur = permet l'instanciation d'une connexion PDO
    public function __construct($_db){
        $this->_pdoConnection = $_db;
    }


    // crée un employé
    public function createEmployee() {
        $sql = "INSERT INTO employee (name, email, age, designation, hiring_date) 
            VALUES (:name, :email, :age, :designation, :hiringDate);";
        $statement = $this->_pdoConnection->prepare($sql);

        $this->_name=htmlspecialchars(strip_tags($this->_name));
        $this->_email=htmlspecialchars(strip_tags($this->_email));
        $this->_age=htmlspecialchars(strip_tags($this->_age));
        $this->_designation=htmlspecialchars(strip_tags($this->_designation));
        $this->_hiringDate=htmlspecialchars(strip_tags($this->_hiringDate));

        $statement->bindParam(":name", $this->_name);
        $statement->bindParam(":email", $this->_email);
        $statement->bindParam(":age", $this->_age);
        $statement->bindParam(":designation", $this->_designation);
        $statement->bindParam(":hiringDate", $this->_hiringDate);

        if($statement->execute()){
//            var_dump($statement);
            return true;
        }
        return false;
    }
    // récupère la liste de tous les employés
    public function getEmployees() {
        $sql = "SELECT id, name, email, age, designation, hiring_date FROM employee;";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute();
//        var_dump($query);
        return $query;
    }
    // récupère un employé par son ID
    public function getEmployee() {
        $sql = "SELECT id, name, email, age, designation, hiring_date FROM employee WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->bindParam(1, $this->_id);
        $query->execute();
//        var_dump($query);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        $this->_id = $row['id'];
        $this->_name = $row['name'];
        $this->_email = $row['email'];
        $this->_age = $row['age'];
        $this->_designation = $row['designation'];
        $this->_hiringDate = $row['hiring_date'];

    }
    // update un employé
    public function updateEmployee() {
        $sql = "UPDATE employee SET name = ?, email = ?, age = ?, designation = ?, hiring_date = ? WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute();
        return $query;
    }
    // supprime un employé
    public function deleteEmployee() {
        $sql = "DELETE FROM employee WHERE id = ?";
        $query = $this->_pdoConnection->prepare($sql);
        $query->execute();
        return $query;
    }
}
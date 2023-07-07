<?php

// Headers requis
header("Access-Control-Allow-Origin: *");
header("content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Employee.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // Instanciation d'employee
    $employee = new Employee($db);

    // On récupère les informations envoyées
    $data = json_decode(file_get_contents("php://input"));
//    var_dump($data);

    // Ici on a reçu les données
    // On hydrate notre objet
    $employee->_name = $data->name;
    $employee->_email = $data->email;
    $employee->_age = $data->age;
    $employee->_designation = $data->designation;
    $employee->_hiringDate = $data->hiring_date;

    if($employee->createEmployee()){
        // Ici la création a fonctionné
        // On envoie un code 201
        http_response_code(201);
        echo json_encode(["message" => "employee creation is success, great success !"]);
    } else {
        // Ici la création n'a pas fonctionné
        // On envoie un code 503
        http_response_code(503);
        echo json_encode(["message" => "did not create employee, you failed !"]);
    }
} else {
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}
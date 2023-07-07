<?php

// Headers requis
header("Access-Control-Allow-Origin: *");
header("content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Employee.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $employee = new Employee($db);

    $data = json_decode(file_get_contents("php://input"));
    var_dump($data);

    if(!empty($data->id)){
        $employee->_id = $data->id;

        // On récupère le produit
        $employee->getEmployee();

        // On vérifie si le produit existe
        if($employee->_name != null){

            $indiv = [
                "id" => $employee->_id,
                "name" => $employee->_name,
                "email" => $employee->_email,
                "age" => $employee->_age,
                "designation" => $employee->_designation,
                "hiringDate" => $employee->_hiringDate
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($indiv);
        }else{
            // 404 Not found
            http_response_code(404);

            echo json_encode(array("message" => "L'employe n'existe pas"));
        }

    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Unauthorized method"]);
}
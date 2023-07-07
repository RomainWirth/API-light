<?php

// Headers requis
header("Access-Control-Allow-Origin: *");
header("content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// vérification que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] = 'GET'){
    // fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Employee.php';

    // Instanciation de la BDD
    $database = new Database();
    $db = $database->getConnection();

    // Instanciation de Employee
    $employee = new Employee($db);

    // récupération des données
    $statement = $employee->getEmployees();

    // vérification de la réponse
    if($statement->rowCount() > 0) {
//        var_dump('hello world');
        // initialisation un tableau associatif
        $tableEmployee = [];
        $tableEmployee['employee'] = [];

        // parcours des lignes du tableau
        while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
//            var_dump("coucou");
//            var_dump($row);
            $indiv = [
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "age" => $age,
                "designation" => $designation,
                "hiring_date" => $hiring_date
            ];
//            var_dump($indiv);
            $tableEmployee['employee'][] = $indiv;
        }
        http_response_code(200);
//        var_dump($tableEmployee);
        echo json_encode($tableEmployee);

    }

} else {
    //gestion de l'erreur
    http_response_code(405); // 405 : méthode non autorisée
    echo json_encode(["message" => "Unauthorized method"]); // indique à l'utilisateur de l'API qu'il n'a pas utilisé la bonne méthode
}
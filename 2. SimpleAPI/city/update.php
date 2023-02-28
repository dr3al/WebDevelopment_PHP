<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");


include_once '../config/database.php';
include_once '../models/city.php';

$database = new Database();
$db = $database->getConnection();

$city = new City($db);


parse_str(file_get_contents('php://input', TRUE), $_PATCH);

if (!empty($_PATCH['id'])) {
    $city->id = $_PATCH['id'];
    $city->name = $_PATCH['name'];

    if($city->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Город изменен."));

    }

    else{
        http_response_code(500);
        echo json_encode(array("message" => "Невозможно изменить город."));
    }

}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Город не изменен. Данные неполные"));
}

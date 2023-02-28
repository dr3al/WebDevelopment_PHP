<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");


include_once '../config/database.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


parse_str(file_get_contents('php://input', TRUE), $_PATCH);

if (!empty($_PATCH['id']) &&
    !empty($_PATCH['name']) &&
    !empty($_PATCH['username']) &&
    !empty($_PATCH['city_id'])) {

    $user->id = $_PATCH['id'];
    $user->name = $_PATCH['name'];
    $user->username = $_PATCH['username'];
    $user->city_id = $_PATCH['city_id'];

    if($user->update()){
        http_response_code(200);
        echo json_encode(array("message" => "Пользователь изменен."));

    }

    else{
        http_response_code(500);
        echo json_encode(array("message" => "Невозможно изменить пользователя."));
    }

}
else{
    http_response_code(400);
    echo json_encode(array("message" => "Невозможно изменить пользователя. Данные неполные."));
}

<?php
header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

// PASS ONLY TOKEN IF EXIST
if(isset($_GET["token"])){
    include "configs/dbconfig.php";

    // VALIDATE TOKEN
    $token = $_GET["token"];

    $token_find_query = "SELECT * FROM `apikeys` WHERE `token` = '$token'";
    $db_token = mysqli_query($conn, $token_find_query);
    if($db_token->num_rows == 0){
        http_response_code(401);
        print_r(json_encode(["error" => "Invalid token"]));
        exit();
    }

    // DECODE POST DATA TO READABLE FORMAT
    $data = json_decode(file_get_contents('php://input'), true);

    // CHECK IF THE DATA EXIST
    if(!$data["app"]){
        http_response_code(400);
        print_r(json_encode(["error" => "App ID / name is required"]));
        exit();
    }
    if(!$data["message"]){
        http_response_code(400);
        print_r(json_encode(["error" => "Message is required"]));
        exit();
    }


    // FIND USER AND FIND APP ID AND USER
    $app_id_find_query = "SELECT * FROM `apps` WHERE `id` = " . $data['app'];
    $find_app = mysqli_query($conn, $app_id_find_query);
    if(mysqli_num_rows($find_app) < 1){
        http_response_code(400);
        print_r(json_encode(["error" => "Invalid App ID"]));
        exit();
    }
    $app_data = mysqli_fetch_assoc($find_app);

    // WE GOT THE DATA THAT WE NEED
    // PROCESS TO INSERT DATA IN TABLE
    $app = $app_data['id'];
    $user = $app_data['user'];
    $message = $data["message"];
    $insert_query = "INSERT INTO `logs` (`app`, `user`, `message`) VALUES ('$app', $user, '$message')";
    $result = mysqli_query($conn, $insert_query);
    if($result){
        print_r(json_encode(["message" => "Data logged"]));
    }else{
        http_response_code(500);
        print_r(json_encode(["error" => "Internal server error"]));
    }
    exit();

}else{
    http_response_code(401);
    print_r(json_encode(["error" => "Invalid token"]));
}


<?php

require '../php/dbOperations.php';

header("Content-Type: application/json");

$method_http = $_SERVER["REQUEST_METHOD"];

$pahts = explode("/", $_SERVER["REQUEST_URI"]);

switch ($method_http) {
    case 'GET':
        $data = [];

        if (isset($_GET["id"])) {
            if (count($pahts) === 5) {
                $id = $pahts[4];
            } else {
                $id = $_GET["id"];
            }

            $response = get($id);
            if ($response) {
                http_response_code(200);
                $data = generateArray($response);
                echo json_encode($data);
            } else {
                http_response_code(401);
                echo json_encode(generteErrors("Invalid id"));
            }
        } else {
            $response = get();
            foreach ($response as $row) {
                array_push($data, generateArray($row));
            }
            echo json_encode(
                array(
                    "count" => count($data),
                    "mettings" => $data
                )
            );
        }

        break;

    case 'POST':
        $data = file_get_contents("php://input");
        $post = json_decode($data, true);
        $result = insert($post);

        if ($result) {
            http_response_code(201);
            echo  json_encode($post);
        } else {
            http_response_code(500);
            echo json_encode(generteErrors("Information not valid"));
        }
        break;

    case 'PUT':
        if (isset($_GET["id"])) {
            $data = file_get_contents("php://input");
            $put = json_decode($data, true);
            $id = $_GET["id"];
            $response = update($put, $id);

            if ($response) {
                echo json_encode($put);
            } else {
                http_response_code(500);
                echo json_encode(generteErrors("Information not valid"));
            }
        } else {
            echo json_encode(generteErrors("Id not valid"));
        }

        break;

    case 'DELETE':
        if (isset($_GET["id"])) {
            $response = delete($_GET["id"]);
            if ($response) {
                http_response_code(204);
            } else {
                http_response_code(500);
                echo json_encode(generteErrors("Information not valid"));
            }
        } else {
            http_response_code(404);
            echo json_encode(generteErrors("Id not valid"));
        }
        break;
}


function generateArray($row)
{
    return array(
        "id" => $row["id"],
        "mascot" =>  $row["mascot"],
        "owner" =>  $row["owner"],
        "phone" =>  $row["phone"],
        "date" =>  $row["date"],
        "time" => $row["time"],
        "symptom" => $row["symptom"]
    );
}


function generteErrors($msj)
{
    return array(
        "errors" => true,
        "messages" => $msj
    );
}

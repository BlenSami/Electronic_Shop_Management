<?php
include "../model/TaskModel.php";

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Split the URL by "/"
$urlParts = explode('/', $currentUrl);

// Get the last part of the URL
$lastPart = end($urlParts);



if ($_SERVER['REQUEST_METHOD'] === 'GET' && $lastPart == "get-all-task") {
    $result = getAllTask();
    if ($result) {

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Task not found']);
    }
} else {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => "Not found"]);
}



//update

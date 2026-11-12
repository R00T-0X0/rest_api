
<?php

header("Content-Type: application/json; charset=UTF-8");

// Read request method
$method = $_SERVER['REQUEST_METHOD'];

// Read request headers
$headers = function_exists('getallheaders') ? getallheaders() : [];

// Read Authorization header
$authorization = $headers['Authorization'] ?? $headers['authorization'] ?? null;

// Read request body
$body = file_get_contents("php://input");

// Function to return JSON response
function sendResponse($status, $data)
{
    http_response_code($status);

    echo json_encode(
        $data,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    exit;
}

// Check JSON data
$data = null;

if ($method === "POST" || $method === "PUT") {

    if (empty($body)) {
        sendResponse(400, [
            "status" => "error",
            "message" => "Request body is empty"
        ]);
    }

    $data = json_decode($body, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        sendResponse(400, [
            "status" => "error",
            "message" => "Invalid JSON data",
            "error" => json_last_error_msg()
        ]);
    }
}

// Handle HTTP methods
switch ($method) {

    case "GET":

        sendResponse(200, [
            "status" => "success",
            "method" => "GET",
            "message" => "GET request received successfully",
            "headers" => $headers,
            "authorization" => $authorization
        ]);

    case "POST":

        sendResponse(201, [
            "status" => "success",
            "method" => "POST",
            "message" => "Data received successfully",
            "headers" => $headers,
            "authorization" => $authorization,
            "data" => $data
        ]);

    case "PUT":

        sendResponse(200, [
            "status" => "success",
            "method" => "PUT",
            "message" => "Data updated successfully",
            "headers" => $headers,
            "authorization" => $authorization,
            "data" => $data
        ]);

    case "DELETE":

        sendResponse(200, [
            "status" => "success",
            "method" => "DELETE",
            "message" => "Delete request received successfully",
            "headers" => $headers,
            "authorization" => $authorization
        ]);

    default:

        header("Allow: GET, POST, PUT, DELETE");

        sendResponse(405, [
            "status" => "error",
            "message" => "Method not allowed"
        ]);
}

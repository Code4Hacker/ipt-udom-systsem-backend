<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PATCH, GET, DELETE");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept");
header("Access-Control-Max-Age: 3600");
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "IPTSYSTEM";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

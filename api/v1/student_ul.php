<?php
include_once "connector.php";


function loginCheck($conn, $t_number, $password) {
    $sql = "SELECT * FROM students WHERE t_number = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $t_number, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}


function updateInfo($conn, $t_number, $mobile, $e_mail, $password) {
    $sql = "UPDATE students SET mobile = ?, e_mail = ?, password = ? WHERE t_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $mobile, $e_mail, $password, $t_number);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = 500;
    $data = json_decode(file_get_contents("php://input"), true);
    $result = loginCheck($conn, $data['t_number'], $data['password']);
    if($result) $status = 200;
    echo json_encode(["status" => $status, "success" => $result, "t_num" => $data['t_number']]);
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $status = 500;
    $data = json_decode(file_get_contents("php://input"), true);
    $result = updateInfo($conn, $data['t_number'], $data['mobile'], $data['e_mail'], $data['password']);
    if($result) $status = 200;
    echo json_encode(["status" => $status, "success" => $result, "t_num" => $data['t_number']]);
}

$conn->close();
?>

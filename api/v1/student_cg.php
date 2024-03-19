<?php

include_once "connector.php";

function addStudent($conn, $f_name, $m_name, $l_name, $t_number, $mobile, $e_mail, $password) {
    $sql = "INSERT INTO students (f_name, m_name, l_name, t_number, mobile, e_mail, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $f_name, $m_name, $l_name, $t_number, $mobile, $e_mail, $password);
    if ($stmt->execute()) {
        return true;
    } else {
        echo json_encode(array("status" => 500, "message" => "Something Wrong"));
        return false;
    }
}

// Function to get all students
function getAllStudents($conn) {
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    $students = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    return $students;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);
    if(!empty($data['f_name']) && !empty($data['m_name']) && !empty($data['l_name']) &&  !empty($data['t_number']) && !empty($data['mobile']) && !empty($data['e_mail']) && !empty($data['password'])){
        $result = addStudent($conn, $data['f_name'], $data['m_name'], $data['l_name'], $data['t_number'], $data['mobile'], $data['e_mail'], $data['password']);
        echo json_encode(["status" => 200, "success" => $result]);
    }else{
        echo json_encode(array("status" => 402, "message" => "fill the field"));
    }
    

} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {

    $students = getAllStudents($conn);
    echo json_encode(array("status" => 200, "students" => $students));
}

$conn->close();
?>

<?php
include_once("connector_2.php");
function insertProject()
{
    $conn = connectDB();

    if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['domain']) && isset($_POST['descr']) && isset($_POST['supervisor']) && isset($_POST['remarks']) && isset($_POST['students']) && isset($_POST['years'])) {

        $stmt = $conn->prepare("INSERT INTO PROJECTS (title, category, domain, descr, supervisor, remarks, students, years) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $title, $category, $domain,  $descr, $supervisor, $remarks, $students, $years);



        $title = htmlspecialchars($_POST['title']);
        $category = $_POST['category'];
        $domain = $_POST['domain'];
        $descr = $_POST['descr'];
        $supervisor = $_POST['supervisor'];
        $remarks = $_POST['remarks'];
        $students = htmlspecialchars($_POST['students']);
        $years = $_POST['years'];
        $students = str_replace('(', '___', $students);

        if ($stmt->execute() === TRUE) {
            echo json_encode(array("status" => 200, "message" => "Success"));
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo json_encode(array("status" => 402, "message" => "Empty Fields"));
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    insertProject();
}

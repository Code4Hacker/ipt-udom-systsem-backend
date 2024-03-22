<?php
include_once("connector_2.php");
function insertSelect()
{
    $conn = connectDB();

    if (isset($_POST['selection']) && isset($_POST['student'])) {

        $stmt = $conn->prepare("INSERT INTO CONTINUE_SELECTED (selection, student) VALUES (?, ?)");
        $stmt->bind_param("ss", $selection, $student);



        $selection = htmlspecialchars($_POST['selection']);
        $student = $_POST['student'];

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
    insertSelect();
}

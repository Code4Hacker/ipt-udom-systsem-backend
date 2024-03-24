<?php
include_once("connector_2.php");
function insertProject()
{
    $conn = connectDB();

    if (isset($_POST['work_hours']) && isset($_POST['week_no']) && isset($_POST['descr']) && isset($_POST['task_for'])) {

        $stmt = $conn->prepare("INSERT INTO LOGBOOK (work_hours, week_no, task_description, task_for) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $work_hours, $week_no, $descr, $task_for);



        $work_hours = $_POST['work_hours'];
        $week_no = $_POST['week_no'];
        $descr = $_POST['descr'];
        $task_for = $_POST['task_for'];

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

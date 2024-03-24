<?php
include_once("connector.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['uploads']) && $_FILES['uploads']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['uploads']['name'];
        $file_tmp = $_FILES['uploads']['tmp_name'];
        $student = $_POST['studentId'];

        $check_for_arrival_exist = "SELECT student FROM ARRIVALNOTE WHERE student = '$student'";
        if (!(($conn->query($check_for_arrival_exist))->num_rows > 0)) {
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            if ($file_extension === 'pdf') {
                $file_destination = "arrivals/GEMINI_" . rand(0, 1_000_000_000) . '_' . pathinfo($file_name, PATHINFO_EXTENSION);

                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $sql = "INSERT INTO ARRIVALNOTE (file_path, student) VALUES  ('$file_destination', '$student')";

                    $result = $conn->query($sql);
                    if ($result) {
                        echo json_encode(array("status" => 200, "message" => "File uploaded successfully."));
                    } else {

                        echo json_encode(array("status" => 500, "message" => "File uploaded unsuccessfully.".$conn -> error));
                    }
                } else {
                    echo json_encode(array("status" => 500, "message" => "Error on Moving File."));
                }
            } else {
                echo json_encode(array("status" => 402, "message" => "Only  PDF file allowed."));
            }
        } else {
            echo json_encode(array("status" => 303, "message" => "Already"));
        }
    } else {
        echo json_encode(array("status" => 200, "message" => "Error on Uploading file."));
    }
}

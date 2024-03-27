<?php

include_once("connector.php");

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        if (isset($_POST['super']) && !empty($_POST['super'])) {
            $super_id = $_POST['super'];
            $sql_get = "SELECT s.*,pos.region,pos.district, pos.place_name FROM STUDENTS s
        INNER JOIN CONTINUE_SELECTED cs ON s.t_number = cs.student
        INNER JOIN PLACE_OF_SELECTION pos ON cs.selection = pos.prId
        WHERE pos.supervisor = '$super_id'";
            $responses = $conn->query($sql_get);
            if ($responses) {
                $row_data = array();
                while ($row = $responses->fetch_assoc()) {
                    $row_data[] = $row;
                }
                echo json_encode(array("status" => 200, "message" => "OK", "students" => $row_data));
            } else {
                echo json_encode(array("status" => 500, "message" => $conn->error));
            }
        } else {
            echo json_encode(array("status" => 402, "message" => "Field Required"));
        }
        break;

    default:
        break;
}

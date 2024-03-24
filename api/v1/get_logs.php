<?php
include_once ("connector.php");

switch($_SERVER['REQUEST_METHOD']){
    case "POST":
        $std_id = $_POST['studentId'];
        $week = $_POST['week'];
        $sql = "SELECT * FROM LOGBOOK WHERE task_for = '$std_id' AND week_no LIKE '$week' ORDER BY lId DESC";

        $receives = $conn -> query($sql);

        if($receives){
            $data = array();
            while($row = $receives -> fetch_assoc()) $data[] = $row;
            echo json_encode(array("status" => 200, "message" => "success", "logbook" => $data));
        }else{
            echo json_encode(array("status" => 500, "message" => $conn -> error));
        }
        break;
    default:
        break;
}
?>


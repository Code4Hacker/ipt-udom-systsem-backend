<?php

include_once("connector.php");

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        $student_t = $_POST['studentId'];
        if (!empty($student_t)) {
            $query = "SELECT s.stdId, CONCAT(s.f_name, ' ', s.l_name) AS student, s.t_number, ai.programAbbr AS programme, ps.place_name AS place, ps.area, ps.region, ps.district, s.mobile AS phone
        FROM STUDENTS s
        INNER JOIN ACADEMICINFOS ai ON s.t_number = ai.std_num
        INNER JOIN CONTINUE_SELECTED cs ON s.t_number = cs.student
        INNER JOIN PLACE_OF_SELECTION ps ON cs.selection = ps.prId
        WHERE s.t_number = '$student_t'";

            $connect_them = $conn->query($query);

            if ($connect_them) {
                echo json_encode(array("arrival" => [$connect_them -> fetch_assoc()]));
            }
        }else{
            echo json_encode(array("status" => 402, "message" => "student Id is Empty!"));
        }
        break;
    default:
        break;
}
?>
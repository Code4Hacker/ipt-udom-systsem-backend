<?php
include_once("connector.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $number_t = $_POST['studentId'];
        $sql = "SELECT s.f_name, s.m_name, s.l_name, s.t_number, s.mobile, s.e_mail,a.collegeAbbr, a.collegeLong, a.departmentAbbr ,a.departmentLong, a.programAbbr, a.programLong
FROM STUDENTS s
INNER JOIN ACADEMICINFOS a ON s.t_number = a.std_num WHERE a.std_num='$number_t'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $data = array();
            while ($row = $result->fetch_assoc()) {
                $user = array(
                    "about" => array(
                        "fullname" => $row["f_name"] . " " . $row["m_name"] . " " . $row["l_name"],
                        "registration" => $row["t_number"],
                        "gender" => "Male",
                        "mobile" => $row["mobile"],
                        "email" => $row["e_mail"]
                    ),
                    "academic" => array(
                        "college" => array(
                            "title" => $row["collegeAbbr"],
                            "description" => $row["collegeLong"]
                        ),
                        "department" => array(
                            "title" => $row["departmentAbbr"],
                            "description" => $row["departmentLong"]
                        ),
                        "program" => array(
                            "title" => $row["programAbbr"],
                            "description" => $row["programLong"]
                        )
                    ),
                    "selection" => array()
                );

                $selection_sql = "SELECT module_name, session_time, venue, lab
                  FROM SELECTIONS
                  INNER JOIN SELECTED ON SELECTIONS.seId = SELECTED.selection
                  WHERE SELECTED.student = '{$row["t_number"]}'";
                $selection_result = $conn->query($selection_sql);
                if ($selection_result->num_rows > 0) {
                    while ($selection_row = $selection_result->fetch_assoc()) {
                        $selection = array(
                            "module" => $selection_row["module_name"],
                            "session" => $selection_row["session_time"],
                            "venue" => $selection_row["venue"],
                            "lab" => $selection_row["lab"]
                        );
                        $user["selection"][] = $selection;
                    }
                }
                $data[] = $user;
            }

            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            echo "0 results";
        }
        $conn->close();
        break;
    default:
        echo json_encode(array("status" => 404, "message" => "method not allowed"));
        break;
}

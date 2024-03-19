<?php
include_once("connector.php");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $number_t = $_POST['studentId'];
        $sql = "SELECT s.f_name, s.m_name, s.l_name, s.t_number, s.mobile, s.e_mail, s.gender,a.collegeAbbr, a.collegeLong, a.departmentAbbr ,a.departmentLong, a.programAbbr, a.programLong
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
                        "gender" => $row["gender"],
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

                $selection_sql = "SELECT * FROM PLACE_OF_SELECTION INNER JOIN CONTINUE_SELECTED ON PLACE_OF_SELECTION.prId = CONTINUE_SELECTED.selection WHERE student = '{$row["t_number"]}'";
                $selection_result = $conn->query($selection_sql);

                // echo $selection_sql;
                if ($selection_result) {


                    while ($selection_row = $selection_result->fetch_assoc()) {
                        $super = "SELECT f_name, m_name, l_name, mobile FROM SUPERVISORS WHERE super_id='{$selection_row["supervisor"]}'";

                        $supert = $conn->query($super);
                        $row_super = $supert -> fetch_assoc();
                        $selection = array(
                            "module" => $selection_row["place_name"],
                            "session" => $selection_row["region"],
                            "venue" => $selection_row["district"],
                            "lab" => $row_super['f_name']." ".$row_super['l_name']." ".$row_super['mobile'],
                            "branch" => $selection_row["branch"],
                            "area" => $selection_row["area"],
                            "category" => $selection_row["category"]
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

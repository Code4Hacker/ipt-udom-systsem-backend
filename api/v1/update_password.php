<?php
include_once("connector.php");

function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
switch($_SERVER['REQUEST_METHOD']){
    case "POST":
        $id = sanitize_input($_POST['studentId']);
        $old_password = sanitize_input($_POST['old']);
        $new_pwd = sanitize_input($_POST['new_pwd']);
        if(!empty($id) && !empty($old_password)){
            $sql_check = "SELECT * FROM STUDENTS WHERE t_number = '$id' AND password = '$old_password'";
            $returned = $conn -> query($sql_check);

            if($returned -> num_rows > 0){
                $update_sql = "UPDATE STUDENTS SET password='$new_pwd' WHERE t_number = '$id' AND password = '$old_password'";

                $response_back = $conn -> query($update_sql);
                if($response_back){
                    echo json_encode(array("status" => 200, "message" => "update Success"));
                }else{
                    echo json_encode(array("status" => 500, "message" => "Error.".$conn -> error));
                }
            }else{
                echo  json_encode(array("status" => 403, "message" => "Old Password is Invalid"));
            }
        }else{
            echo json_encode(array("status" => 402, "message" => "Old Password Field is Empty."));
        }
        break;
    default:
        break;
}
?>
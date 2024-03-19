<?php
include_once ("connector.php");


$sql = "SELECT pId, title, category, domain, descr, supervisor, remarks, students, years FROM PROJECTS ORDER BY pId DESC";
$result = $conn->query($sql);

$projects = array();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $project = array(
      "sn" => $row["pId"],
      "name" => $row["title"],
      "category" => $row["category"],
      "domain" => $row["domain"],
      "description" => $row["descr"],
      "supervisor" => $row["supervisor"],
      "remarks" => $row["remarks"],
      "students" => array(),
      "year" => $row["years"]
    );

    $students = explode(",", $row["students"]);
    foreach ($students as $student) {
      $student = trim($student);
      $student_data = explode("(", $student);
      $student_name = trim($student_data[0]);
      array_push($project["students"], array("student" => $student_name));
    }

    array_push($projects, $project);
  }
}

$conn->close();

$json_data = json_encode($projects);

echo $json_data;

?>


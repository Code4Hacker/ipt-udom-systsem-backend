<?php
include_once("connector.php");


$sql = "SELECT * FROM PLACE_OF_SELECTION";
$result = $conn->query($sql);

$projects = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $project = array(
            "sn" => $row["prId"],
            "name" => $row["place_name"],
            "category" => $row["category"],
            "domain" => $row["capacity"],
            "description" => $row["branch"],
            "supervisor" => $row["area"],
            "remarks" => $row["region"],
            "students" => $row["district"]
        );
        array_push($projects, $project);
    }

    $json_data = json_encode($projects);
}

$conn->close();


echo $json_data;

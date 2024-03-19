<?php
include_once ("connector.php");
function getAllSelections($conn) {
  
  $sql = "SELECT f_name,m_name,l_name,t_number FROM STUDENTS";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = array(
        "name" => $row['f_name']." ".$row['m_name']." ".$row['l_name']."(".$row['t_number'].")"
      );
    }
    return $data;
  } else {
    return null;
  }

  $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $allData = getAllSelections($conn);

  if ($allData) {
    echo json_encode($allData);
  } else {
    echo "No data found.";
  }
} else {
  echo "This script requires a POST request.";
}
?>

<?php
require('cons.php');

// Fetch data from the database
$sql = "SELECT employee.name, employee.department, performance_ratings.efficiency, performance_ratings.profficiency 
        FROM employee
        JOIN performance_ratings ON employee.ratings_id = performance_ratings.ratings_id";

$result = $conn->query($sql);

if ($result) {
  // Check if there are rows in the result
  if ($result->num_rows > 0) {
    // Fetch data and prepare for chart
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = array(
        'name' => $row["name"],
        'department' => $row["department"],
        'efficiency' => $row["efficiency"],
        'profficiency' => $row["profficiency"],
        'ratings' => ($row["profficiency"] + $row["efficiency"] )/2,
      );
    }
    $conn->close();

    // Convert data to JSON for JavaScript
    $jsonData = json_encode($data);
  } else {
    echo "0 results";
  }
} else {
  echo "Error: " . $conn->error;
}

?>
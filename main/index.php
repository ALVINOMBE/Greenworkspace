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

    // Close the database connection
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Performance Chart</title>
  <!-- Include Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      text-align: center;
    }

    #performanceChart {
      margin: 20px auto;
    }

    table {
      border-collapse: collapse;
      width: 80%;
      margin: 20px auto;
      border: 1px solid #dddddd;
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>

<!-- Chart container -->
<canvas id="performanceChart" width="1500" height="400"></canvas>

<script>
// Parse the JSON data
var jsonData = <?php echo $jsonData; ?>;

// Extract labels and data for the chart
var labels = jsonData.map(function(item) {
  return 'Name : ' + item.name + '  ' + 'Department : ' + item.department;
});

var efficiencyData = jsonData.map(function(item) {
  return item.efficiency;
});

var profficiencyData = jsonData.map(function(item) {
  return item.profficiency;
});

var ratingsData = jsonData.map(function(item){
  return item.ratings
});

// Create a stacked bar chart
var ctx = document.getElementById('performanceChart').getContext('2d');
var performanceChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [
      {
        label: 'Efficiency',
        data: efficiencyData,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      },
      {
        label: 'Profficiency',
        data: profficiencyData,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
      },
      {
        label:'Ratings',
        data:ratingsData,
        backgroundColor: 'rgba(196,249,112,0.2)',
        borderColor: 'rgba(178, 222, 39, 1)',
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    animation: {
      duration: 2000, // Animation duration in milliseconds
      easing: 'easeInOutQuart', // Easing function for the animation
    }
  }
});
</script>

<!-- Table for displaying query data -->
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Department</th>
      <th>Efficiency</th>
      <th>Profficiency</th>
      <th>Ratings</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Loop through the data to populate the table rows
    foreach ($data as $item) {
      echo "<tr>";
      echo "<td>{$item['name']}</td>";
      echo "<td>{$item['department']}</td>";
      echo "<td>{$item['efficiency']}</td>";
      echo "<td>{$item['profficiency']}</td>";
      echo "<td>{$item['ratings']}</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>


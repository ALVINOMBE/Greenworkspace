<?php require('query.php')?>
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
<canvas id="performanceChart" width="1400" height="400"></canvas>

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
      duration: 2000,
      easing: 'easeInOutQuart', 
    }
  }
});
</script>

</body>
</html>


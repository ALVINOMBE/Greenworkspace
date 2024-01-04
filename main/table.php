<?php require('chart.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <script>
        var jsonData = <?php echo $jsonData; ?>;
    </script>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Efficiency</th>
                <th>Proficiency</th>
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

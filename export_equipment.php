<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EMS";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers to force download as Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=all_equipment_data.xls");

echo "<table border='1'>";
echo "<tr style='font-weight: bold; background-color: #f2f2f2;'>
        <td>Serial Number</td>
        <td>Equipment Name</td>
        <td>Brand</td>
        <td>Year Purchased</td>
        <td>Property Number</td>
        <td>Model Number</td>
        <td>Acquired Date</td>
        <td>Acquired Cost</td>
        <td>Person Accountable</td>
        <td>Status</td>
      </tr>";

$sql = "SELECT 
            serialNumber,
            equipmentName,
            brand,
            yearPurchased,
            propertyNumber,
            modelNumber,
            acquiredDate,
            acquiredCost,
            personAccountable,
            status
        FROM equipment
        ORDER BY equipmentName ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['serialNumber']}</td>
                <td>{$row['equipmentName']}</td>
                <td>{$row['brand']}</td>
                <td>{$row['yearPurchased']}</td>
                <td>{$row['propertyNumber']}</td>
                <td>{$row['modelNumber']}</td>
                <td>{$row['acquiredDate']}</td>
                <td>{$row['acquiredCost']}</td>
                <td>{$row['personAccountable']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
}

echo "</table>";
$conn->close();
?>

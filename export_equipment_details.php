<?php
if (!isset($_GET['equipmentName'])) {
    die("No equipment name provided.");
}

$equipmentName = urldecode($_GET['equipmentName']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EMS";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers to prompt Excel download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . str_replace(" ", "_", $equipmentName) . "_Details.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start the table
echo "<table border='1'>";

// Output bold headers
echo "<tr style='font-weight: bold; background-color: #f2f2f2;'>
        <td>Serial Number</td>
        <td>Status</td>
        <td>Brand</td>
        <td>Year Purchased</td>
        <td>Property Number</td>
        <td>Model Number</td>
        <td>Acquired Date</td>
        <td>Acquired Cost</td>
        <td>Person Accountable</td>
        <td>Location</td>
      </tr>";

// Prepare and run query
$sql = "SELECT 
            serialNumber,
            status,
            brand,
            yearPurchased,
            propertyNumber,
            modelNumber,
            acquiredDate,
            acquiredCost,
            personAccountable,
            location
        FROM equipment
        WHERE equipmentName = ?
        ORDER BY serialNumber ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $equipmentName);
$stmt->execute();
$result = $stmt->get_result();

// Output data rows
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['serialNumber']}</td>
            <td>{$row['status']}</td>
            <td>{$row['brand']}</td>
            <td>{$row['yearPurchased']}</td>
            <td>{$row['propertyNumber']}</td>
            <td>{$row['modelNumber']}</td>
            <td>{$row['acquiredDate']}</td>
            <td>{$row['acquiredCost']}</td>
            <td>{$row['personAccountable']}</td>
            <td>{$row['location']}</td>
          </tr>";
}

echo "</table>";

// Clean up
$stmt->close();
$conn->close();
?>

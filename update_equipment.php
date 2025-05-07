<?php
$connection = new mysqli("localhost", "root", "", "ems");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents("php://input"));

$query = "UPDATE equipment SET 
    equipmentName = ?, 
    brand = ?, 
    yearPurchased = ?, 
    propertyNumber = ?, 
    modelNumber = ?, 
    acquiredDate = ?, 
    acquiredCost = ?, 
    personAccountable = ?, 
    location = ?, 
    status = ?
    WHERE serialNumber = ?";

$stmt = $connection->prepare($query);
$stmt->bind_param("sssssssssss", 
    $data->equipmentName,
    $data->brand,
    $data->yearPurchased,
    $data->propertyNumber,
    $data->modelNumber,
    $data->acquiredDate,
    $data->acquiredCost,
    $data->personAccountable,
    $data->location,
    $data->status,
    $data->serialNumber
);

if ($stmt->execute()) {
    echo "Updated successfully";
} else {
    echo "Error updating: " . $connection->error;
}

$stmt->close();
$connection->close();
?>

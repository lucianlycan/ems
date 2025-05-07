<?php
include 'db_connection.php';

header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "DELETE FROM borrow_records WHERE status = 'Returned'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Returned equipment history cleared successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error deleting records: " . $conn->error]);
}

$conn->close();
?>

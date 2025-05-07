<?php
require 'db_connection.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=users_data.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Student ID', 'Full Name', 'Year', 'Email']);

$query = "SELECT id_number, full_name, year, email FROM users";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>

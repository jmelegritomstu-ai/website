<?php
include 'db_connect.php';

$branch = $_GET['branch'];
$result = $conn->query("SELECT * FROM employees WHERE branch='$branch'");

$employees = [];
while ($row = $result->fetch_assoc()) {
  $employees[] = $row;
}

echo json_encode($employees);
$conn->close();
?>

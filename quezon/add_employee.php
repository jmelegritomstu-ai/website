<?php
include 'db_connect.php';

$employee_id = $_POST['employee_id'];
$name = $_POST['name'];
$secondary_branch = $_POST['secondary_branch'];
$job_position = $_POST['job_position'];
$work_schedule = $_POST['work_schedule'];
$age = $_POST['age'];
$contact_no = $_POST['contact_no'];
$status = $_POST['status'];

$imageData = null;
if (!empty($_FILES['image']['tmp_name'])) {
  $imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}

$sql = "INSERT INTO quezon (employee_id, name, image, secondary_branch, job_position, work_schedule, age, contact_no, status)
VALUES ('$employee_id', '$name', '$imageData', '$secondary_branch', '$job_position', '$work_schedule', '$age', '$contact_no', '$status')";

if ($conn->query($sql)) {
   echo "<script>alert('Employee added successfully!'); window.location.href='employees.php';</script>";
} else {
  echo "Error: " . $conn->error;
}
?>

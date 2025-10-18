<?php
include 'db_connect.php';

$id = $_POST['id'];
$employee_id = $_POST['employee_id'];
$name = $_POST['name'];
$secondary_branch = $_POST['secondary_branch'];
$job_position = $_POST['job_position'];
$work_schedule = $_POST['work_schedule'];
$age = $_POST['age'];
$contact_no = $_POST['contact_no'];
$status = $_POST['status'];

// Check if new image is uploaded
if (!empty($_FILES['image']['tmp_name'])) {
    $imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $sql = "UPDATE employees SET 
                employee_id = '$employee_id',
                name = '$name',
                image = '$imageData',
                secondary_branch = '$secondary_branch',
                job_position = '$job_position',
                work_schedule = '$work_schedule',
                age = '$age',
                contact_no = '$contact_no',
                status = '$status'
            WHERE id = '$id'";
} else {
    $sql = "UPDATE employees SET 
                employee_id = '$employee_id',
                name = '$name',
                secondary_branch = '$secondary_branch',
                job_position = '$job_position',
                work_schedule = '$work_schedule',
                age = '$age',
                contact_no = '$contact_no',
                status = '$status'
            WHERE id = '$id'";
}

// ✅ Execute query for both cases
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Employee updated successfully!'); window.location.href='employees.php';</script>";
} else {
    echo "<script>alert('Error updating employee: " . mysqli_error($conn) . "');</script>";
}

mysqli_close($conn);
?>

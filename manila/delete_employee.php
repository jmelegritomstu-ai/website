<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM employees WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Employee deleted successfully!'); window.location.href='employees.php';</script>";
    } else {
        echo "<script>alert('Error deleting employee: " . mysqli_error($conn) . "');</script>";
    }
}
?>

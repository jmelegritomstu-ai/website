<?php
// update_employee.php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name'] ?? '');
    $main_branch = trim($_POST['main_branch'] ?? '');
    $store_branch = trim($_POST['store_branch'] ?? '');
    $job_position = trim($_POST['job_position'] ?? '');
    $work_schedule = trim($_POST['work_schedule'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $contact_no = trim($_POST['contact_no'] ?? '');
    $status = $_POST['status'] ?? 'Active';

    // handle upload if provided
    $imagePath = null;
    if (!empty($_FILES['photo']['name'])) {
        $uploadsDir = 'uploads';
        if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);
        $filename = time() . '_' . basename($_FILES['photo']['name']);
        $target = $uploadsDir . '/' . $filename;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $imagePath = $target;
            // update including image
            $stmt = $conn->prepare("UPDATE employees SET name=?, main_branch=?, store_branch=?, job_position=?, work_schedule=?, age=?, contact_no=?, status=?, image=? WHERE id=?");
            $stmt->bind_param("sssssiissi", $name, $main_branch, $store_branch, $job_position, $work_schedule, $age, $contact_no, $status, $imagePath, $id);
        }
    } else {
        // update without changing image
        $stmt = $conn->prepare("UPDATE employees SET name=?, main_branch=?, store_branch=?, job_position=?, work_schedule=?, age=?, contact_no=?, status=? WHERE id=?");
        $stmt->bind_param("sssssissi", $name, $main_branch, $store_branch, $job_position, $work_schedule, $age, $contact_no, $status, $id);
    }

    $stmt->execute();
    $stmt->close();

    // redirect back to tracking with same params if provided
    $redirect = 'tracking.php';
    if (!empty($_POST['main_branch']) && !empty($_POST['store_branch'])) {
        $redirect .= '?main=' . urlencode($_POST['main_branch']) . '&store=' . urlencode($_POST['store_branch']);
    }
    header("Location: $redirect");
    exit;
}

header("Location: tracking.php");
exit;

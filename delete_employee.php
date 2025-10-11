<?php
// delete_employee.php
include 'db_connect.php';

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);

    // optionally delete image file
    $stmt = $conn->prepare("SELECT image FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if ($image && file_exists($image)) {
        @unlink($image);
    }

    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// redirect back (if branch params exist preserve them)
$redirect = 'tracking.php';
if (!empty($_GET['main']) && !empty($_GET['store'])) {
    $redirect .= '?main=' . urlencode($_GET['main']) . '&store=' . urlencode($_GET['store']);
}
header("Location: $redirect");
exit;

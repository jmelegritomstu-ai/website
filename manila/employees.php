<?php
$branch = "Manila";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "mze_manila"; // change to your branch database

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, employee_id, name, secondary_branch, job_position, work_schedule, age, contact_no, status, image FROM employees ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MZE <?php echo $branch; ?> | Employee Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      display: flex;
      height: 100vh;
      background-color: black;
      color: white;
      font-family: 'Poppins', sans-serif;
    }
    .sidebar {
      width: 20vw;
      background-color: #000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px 0;
    }
    .brand { text-align: center; }
    .brand img {
      width: 60px; height: 60px; border-radius: 50%;
    }
    .brand h2 { color: #00bfff; font-size: 20px; font-weight: 600; margin-top: 10px; }
    .nav-links a {
      display: block; padding: 15px 30px; color: white; text-decoration: none;
      transition: 0.3s;
    }
    .nav-links a:hover, .nav-links a.active {
      background-color: #1e90ff; border-radius: 10px;
    }
    .logout { color: gray; text-align: center; padding: 15px; }
    .main-content {
      flex: 1;
      background: white;
      border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      margin: 15px;
      padding: 25px;
      color: black;
      position: relative;
      overflow: hidden;
    }
    h2 { text-align: center; font-weight: 600; margin-bottom: 25px; }
    .table thead { background-color: #000; color: white; }
    .table th, .table td { vertical-align: middle; }
    .add-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 70px; height: 70px;
      border-radius: 50%;
      background-color: #6610f2;
      color: white;
      font-size: 36px;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
      transition: all 0.3s ease;
      z-index: 999;
    }
    .add-btn:hover {
      background-color: #520dc2; transform: scale(1.1);
    }
    img.employee-photo {
      width: 60px; height: 60px; object-fit: cover; border-radius: 50%;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <div class="brand">
        <img src="https://cdn-icons-png.flaticon.com/512/1041/1041916.png" alt="MZE Logo">
        <h2>MZE Cellular</h2>
      </div>
      <div class="nav-links">
        <a href="main/dashboard.php">Dashboard</a>
        <a href="main/reports.php">Reports</a>
        <a href="main/analytics.php" class="active">Analytics</a>
        <a href="#">Inventory</a>
        <a href="#">Settings</a>
      </div>
    </div>
    <div class="logout">Logout</div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2>MZE <?php echo $branch; ?> Branch Employees</h2>

    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Store Branch</th>
            <th>Job Position</th>
            <th>Work Schedule</th>
            <th>Age</th>
            <th>Contact No.</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>";
        if (!empty($row['image'])) {
          echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "'
                width='100' height='100'
                class='rounded-circle border border-3 shadow-sm'
                style='object-fit: cover;'>";
        } else {
          echo "<img src='https://cdn-icons-png.flaticon.com/512/847/847969.png'
                width='100' height='100'
                class='rounded-circle border border-3 shadow-sm'>";
        }
    echo "</td>
      <td>" . htmlspecialchars($row['employee_id']) . "</td>
      <td>" . htmlspecialchars($row['name']) . "</td>
      <td>" . htmlspecialchars($row['secondary_branch']) . "</td>
      <td>" . htmlspecialchars($row['job_position']) . "</td>
      <td>" . htmlspecialchars($row['work_schedule']) . "</td>
      <td>" . htmlspecialchars($row['age']) . "</td>
      <td>" . htmlspecialchars($row['contact_no']) . "</td>
      <td>" . htmlspecialchars($row['status']) . "</td>
      <td>
        <button class='btn btn-sm btn-primary edit-btn'
          data-id='{$row['id']}'
          data-employee_id='{$row['employee_id']}'
          data-name='{$row['name']}'
          data-branch='{$row['secondary_branch']}'
          data-job='{$row['job_position']}'
          data-schedule='{$row['work_schedule']}'
          data-age='{$row['age']}'
          data-contact='{$row['contact_no']}'
          data-status='{$row['status']}'>Edit</button>
        <button class='btn btn-sm btn-danger delete-btn' data-id='{$row['id']}'>Delete</button>
      </td>
    </tr>";
  }
} else {
  echo "<tr><td colspan='10'>No employees found</td></tr>";
}
?>

        </tbody>
      </table>
    </div>
  </div>

  <!-- Floating Add Button -->
  <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">+</button>

  <?php include 'employee_modals.php'; ?>

 <!-- DELETE CONFIRMATION MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p style="font-size: 18px; color: #333;">
          ⚠️ Are you sure you want to delete this information?<br>
          <span style="font-size: 14px; color: gray;">This action cannot be undone.</span>
        </p>
      </div>
      <div class="modal-footer justify-content-center">
        <form method="GET" action="delete_employee.php">
          <input type="hidden" name="id" id="delete_id">
          <button type="submit" class="btn btn-danger px-4">Delete</button>
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  // Edit Modal JS
  document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const editModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    editButtons.forEach(button => {
      button.addEventListener('click', () => {
        document.getElementById('edit_id').value = button.dataset.id;
        document.getElementById('edit_employee_id').value = button.dataset.employee_id;
        document.getElementById('edit_name').value = button.dataset.name;
        document.getElementById('edit_branch').value = button.dataset.branch;
        document.getElementById('edit_job').value = button.dataset.job;
        document.getElementById('edit_schedule').value = button.dataset.schedule;
        document.getElementById('edit_age').value = button.dataset.age;
        document.getElementById('edit_contact').value = button.dataset.contact;
        document.getElementById('edit_status').value = button.dataset.status;
        document.getElementById('edit_preview').src = button.dataset.image;
        editModal.show();
      });
    });

    deleteButtons.forEach(button => {
      button.addEventListener('click', () => {
        document.getElementById('delete_id').value = button.dataset.id;
        deleteModal.show();
      });
    });
  });

  function editPreview(event) {
    const reader = new FileReader();
    reader.onload = function() {
      document.getElementById('edit_preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
  </script>
</body>
</html>

<?php $conn->close(); ?>

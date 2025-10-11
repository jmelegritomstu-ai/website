<?php
include '../back/db_connect.php';

// Get selected main branch (if clicked)
$main_branch_id = isset($_GET['main']) ? intval($_GET['main']) : 0;

// Fetch all main branches
$main_branches = $conn->query("SELECT * FROM main_branches ORDER BY name ASC");

// Define variables
$employees = [];
$main_branch_name = '';

// If a branch is clicked → fetch all employees under its secondary branches
if ($main_branch_id) {
    // Get main branch name first
    $branch_query = $conn->query("SELECT name FROM main_branches WHERE id = $main_branch_id");
    if ($branch_query && $branch_query->num_rows > 0) {
        $main_branch_name = $branch_query->fetch_assoc()['name'];
    } else {
        $main_branch_name = 'Unknown';
    }

    // ✅ Corrected Query
    $sql = "SELECT e.*, s.name AS secondary_name
            FROM employees e
            JOIN secondary_branches s ON e.secondary_branch_id = s.id
            WHERE s.main_branch_id = $main_branch_id
            ORDER BY s.name, e.name ASC";

    $employees = $conn->query($sql);

    if (!$employees) {
        die("SQL Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Employee Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .branch-card {
      cursor: pointer;
      transition: 0.3s;
    }
    .branch-card:hover {
      transform: scale(1.05);
    }
    .floating-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #0d6efd;
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 30px;
      border: none;
    }
  </style>
</head>
<body class="p-4">

<div class="container">
  <h2 class="mb-4 text-center">MZE Branches</h2>

  <?php if (!$main_branch_id): ?>
    <div class="row g-3">
      <?php while ($row = $main_branches->fetch_assoc()): ?>
        <div class="col-md-3">
          <div class="card branch-card text-center p-3" onclick="window.location='tracking.php?main=<?= $row['id'] ?>'">
            <h5><?= htmlspecialchars($row['name']) ?></h5>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <h3 class="mb-4 text-center">
      Employees under <?= htmlspecialchars($main_branch_name) ?>
    </h3>

    <table class="table table-bordered">
      <thead class="table-primary">
        <tr>
          <th>Name</th>
          <th>Secondary Branch</th>
          <th>Job Position</th>
          <th>Work Schedule</th>
          <th>Age</th>
          <th>Contact</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($employees->num_rows > 0): ?>
          <?php while ($emp = $employees->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($emp['name']) ?></td>
              <td><?= htmlspecialchars($emp['secondary_name']) ?></td>
              <td><?= htmlspecialchars($emp['job_position']) ?></td>
              <td><?= htmlspecialchars($emp['work_schedule']) ?></td>
              <td><?= htmlspecialchars($emp['age']) ?></td>
              <td><?= htmlspecialchars($emp['contact_no']) ?></td>
              <td><?= htmlspecialchars($emp['status']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7" class="text-center">No employees found under this main branch.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <button class="floating-btn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">+</button>
  <?php endif; ?>
</div>

<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="insert_employee.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body row g-3">
          <input type="hidden" name="main_branch_id" value="<?= $main_branch_id ?>">

          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Secondary Branch</label>
            <select name="secondary_branch_id" class="form-select" required>
              <option value="">Select Branch</option>
              <?php
              $branches = $conn->query("SELECT * FROM secondary_branches WHERE main_branch_id = $main_branch_id ORDER BY name ASC");
              if ($branches && $branches->num_rows > 0):
                while ($b = $branches->fetch_assoc()):
              ?>
                <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['name']) ?></option>
              <?php
                endwhile;
              else:
                echo '<option value="">No branches found</option>';
              endif;
              ?>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Job Position</label>
            <input type="text" name="job_position" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Work Schedule</label>
            <input type="text" name="work_schedule" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Age</label>
            <input type="number" name="age" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Contact No.</label>
            <input type="text" name="contact_no" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="Active">Active</option>
              <option value="Pending">Pending</option>
              <option value="Penalty-Late">Penalty-Late</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Photo</label>
            <input type="file" name="image" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

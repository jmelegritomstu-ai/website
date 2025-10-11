<?php $branch = "Caloocan"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MZE Caloocan | Employee Tracking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
    .container { margin-top: 50px; }
    h2 { font-weight: 600; text-align: center; margin-bottom: 30px; }
    .add-btn { position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; background-color: #6610f2; color: white; border: none; border-radius: 50%; font-size: 30px; display: flex; justify-content: center; align-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.3); cursor: pointer; transition: 0.3s; }
    .add-btn:hover { background-color: #520dc2; transform: scale(1.1); }
    .employee-img { width: 100px; height: 100px; border-radius: 50%; background-color: #ddd; display: flex; justify-content: center; align-items: center; margin-bottom: 10px; }
    .form-label { font-weight: 500; }
    .modal-header { background-color: #6610f2; color: white; }
  </style>
</head>
<body>
  <div class="container">
    <h2>MZE Caloocan Branch Employees</h2>
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>Photo</th><th>Name</th><th>Job Position</th><th>Work Schedule</th><th>Age</th><th>Contact No.</th><th>Status</th><th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  <button class="add-btn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">+</button>
  <?php include '../includes/employee_modals.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

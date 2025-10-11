<?php
// analytics.php
$branches = [
  'manila' => 'MZE Manila',
  'quezon' => 'MZE Quezon',
  'caloocan' => 'MZE Caloocan',
  'paranaque' => 'MZE Paranaque',
  'pasay' => 'MZE Pasay',
  'marikina' => 'MZE Marikina',
  'taguig' => 'MZE Taguig',
  'cavite' => 'MZE Cavite'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MZE Cellular | Analytics Overview</title>
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

    /* Sidebar */
    .sidebar {
      width: 20vw;
      background-color: #000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px 0;
    }

    .brand {
      text-align: center;
    }

    .brand img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
    }

    .brand h2 {
      margin-top: 10px;
      color: #00bfff;
      font-size: 20px;
      font-weight: 600;
    }

    .nav-links a {
      display: block;
      padding: 15px 30px;
      color: white;
      text-decoration: none;
      transition: 0.3s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background-color: #1e90ff;
      border-radius: 10px;
    }

    .logout {
      color: gray;
      text-align: center;
      padding: 15px;
    }

    /* Main content */
    .main-content {
      flex: 1;
      background: white;
      border-top-left-radius: 25px;
      border-bottom-left-radius: 25px;
      margin: 15px;
      padding: 25px;
      color: black;
      overflow: hidden;
    }

    h2 {
      text-align: center;
      font-weight: 600;
      margin-bottom: 25px;
    }

    /* Branch grid */
    .branch-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      height: calc(100% - 60px);
    }

    .branch-box {
      background-color: purple;
      color: white;
      border-radius: 15px;
      text-align: center;
      padding: 20px;
      cursor: pointer;
      transition: 0.3s;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .branch-box:hover {
      background-color: white;
      color: purple;
      transform: scale(1.05);
    }

    .branch-box img {
      width: 70px;
      height: 70px;
      margin-bottom: 10px;
    }

    @media (max-width: 1200px) {
      .branch-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 768px) {
      .branch-grid {
        grid-template-columns: repeat(2, 1fr);
      }
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
        <a href="dashboard.php">Dashboard</a>
        <a href="reports.php">Reports</a>
        <a href="analytics.php" class="active">Analytics</a>
        <a href="#">Employees</a>
        <a href="#">Inventory</a>
        <a href="#">Settings</a>
      </div>
    </div>
    <div class="logout">Logout</div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2>MZE Branches Overview</h2>
    <div class="branch-grid">
      <?php foreach ($branches as $key => $name): ?>
        <div class="branch-box" onclick="goToEmployees('<?php echo $key; ?>')">
          <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="<?php echo $name; ?>" />
          <h4><?php echo $name; ?></h4>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    function goToEmployees(branch) {
      window.location.href = `tracking/tracking.php`;
    }
  </script>

</body>
</html>

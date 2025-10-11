<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = htmlspecialchars($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Analytics Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      background-color: black;
      font-family: Arial, sans-serif;
      height: 100vh;
      color: white;
    }

    .sidebar {
      width: 20vw;
      background-color: black;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px 0;
      overflow-y: auto;
    }

    .logo-section {
      margin-bottom: 40px;
      padding-left: 20px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.2em;
      font-weight: bold;
    }

    .logo-icon {
      width: 30px;
      height: 30px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: black;
      font-weight: bold;
    }

    .nav-tabs {
      display: flex;
      flex-direction: column;
      gap: 20px;
      padding-left: 20px;
    }

    .tab,
    .sub-tab {
      display: block;
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background-color 0.3s;
      cursor: pointer;
    }

    .tab:hover,
    .sub-tab:hover {
      background-color: #222;
    }

    .tab.active {
      background-color: #444;
    }

    .tab.logout {
      color: gray;
      margin-top: auto;
    }

    .tab-container {
      position: relative;
    }

    .sub-tabs {
      display: none;
      flex-direction: column;
      background-color: #111;
      margin-top: 5px;
      border-radius: 8px;
      padding: 5px;
    }

    .sub-tabs.show {
      display: flex;
    }

    .main-content {
      flex-grow: 1;
      padding: 20px;
      background: radial-gradient(circle, white, skyblue, lightgreen);
      border-radius: 20px;
      margin: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <!-- Logo Section -->
      <div class="logo-section">
        <div class="logo">
          <div class="logo-icon">A</div>
          <span>AnalyticsPro</span>
        </div>
      </div>

      <!-- Navigation Tabs with Links -->
      <div class="nav-tabs">
        <!-- Dashboard with clickable sub-menu -->
        <div class="tab-container">
          <div class="tab active" id="dashboardToggle">Dashboard</div>
          <div class="sub-tabs" id="dashboardSubmenu">
            <a href="overview.html" class="sub-tab">Overview</a>
            <a href="stats.html" class="sub-tab">Statistics</a>
          </div>
        </div>

        <a href="reports.html" class="tab">Reports</a>
        <a href="analytics.html" class="tab">Analytics</a>
        <a href="users.html" class="tab">Users</a>
        <a href="settings.html" class="tab">Settings</a>
        <a href="files.html" class="tab">Files</a>
      </div>
    </div>

    <!-- Logout -->
    <a href="logout.html" class="tab logout">Logout</a>
  </div>

  <!-- Main Section -->
  <div class="main-content">
    <!-- Future dashboard components will go here -->
  </div>

  <!-- JavaScript to toggle submenu -->
  <script>
    const dashboardToggle = document.getElementById('dashboardToggle');
    const dashboardSubmenu = document.getElementById('dashboardSubmenu');

    dashboardToggle.addEventListener('click', () => {
      dashboardSubmenu.classList.toggle('show');
    });
  </script>
</body>
</html>

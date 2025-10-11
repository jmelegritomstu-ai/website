<?php
session_start();

// Dummy credentials (replace with database check in production)
$valid_user = 'admin';
$valid_pass = 'password';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);
    if ($user === $valid_user && $pass === $valid_pass) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login — MZE Cellular</title>
  <style>
    body { display:flex; justify-content:center; align-items:center;
      height:100vh; margin:0; background:#ff9900; font-family:'Segoe UI', sans-serif;}
    .login-box { background:#fff; padding:40px; border-radius:12px;
      width:320px; box-shadow:0 4px 20px rgba(0,0,0,0.1); text-align:center;}
    .login-box h2 { margin-bottom:20px; color:#111; }
    .login-box input {
      width:100%; padding:12px; margin:8px 0; border:1px solid #ccc;
      border-radius:6px; font-size:16px;
    }
    .login-box button {
      width:100%; padding:12px; margin-top:16px;
      background:#111; color:#fff; border:none; font-size:16px;
      border-radius:6px; cursor:pointer; transition:background .3s;
    }
    .login-box button:hover { background:#333; }
    .login-box .error { color: #d9534f; margin-top:10px; font-size:14px; }
  </style>
</head>
<body>
  <form class="login-box" method="POST" action="">
    <h2>MZE Cellular Login</h2>
    <input type="text" name="username" placeholder="Username" required autofocus>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Log In</button>
    <?php if ($error): ?>
      <div class="error"><?=htmlspecialchars($error)?></div>
    <?php endif; ?>
  </form>
</body>
</html>

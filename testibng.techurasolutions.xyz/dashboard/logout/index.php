<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="refresh" content="3;url=login.php" />
  <title>Logging Out...</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9fafb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
      margin: 0;
    }
    .logout-container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
      text-align: center;
    }
    .logout-container h1 {
      margin-bottom: 1rem;
      color: #e53e3e;
    }
    .logout-container p {
      margin-bottom: 0.5rem;
    }
    .logout-container a {
      color: #3182ce;
      text-decoration: none;
      font-weight: bold;
    }
    .logout-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="logout-container">
    <h1>You have been logged out.</h1>
    <p>Redirecting to <a href="/login">login page</a>...</p>
    <p>If you are not redirected automatically, click the link above.</p>
  </div>
</body>
</html>

<?php
session_start();

// Database connection config
$host = 'localhost';
$db   = 'JournalJoy_DB';
$user = '123'; // <-- replace with your DB username
$pass = 'wo44Ud0^1'; // <-- replace with your DB password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$errors = [];
$username = '';
$email = '';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate username
    if (strlen($username) < 3) {
        $errors['username'] = "Username must be at least 3 characters.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }

    // Validate password length
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters.";
    }

    // Confirm password match
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Check if email already exists
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = "Email is already registered.";
        }
    }

    // Insert user if no errors
    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $passwordHash])) {
            $_SESSION['user_email'] = $email;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $errors['general'] = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Sign Up | JournalJoy</title>
<style>
  /* ... your CSS here ... */
</style>
</head>
<body>
  <main class="container" role="main">
    <h2>Create Your Account</h2>

    <?php if (!empty($errors['general'])): ?>
      <div class="error" role="alert"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required minlength="3" />
      <?php if (isset($errors['username'])): ?>
        <div class="error" role="alert"><?= htmlspecialchars($errors['username']) ?></div>
      <?php endif; ?>

      <label for="email">Email address</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required />
      <?php if (isset($errors['email'])): ?>
        <div class="error" role="alert"><?= htmlspecialchars($errors['email']) ?></div>
      <?php endif; ?>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required minlength="8" />
      <?php if (isset($errors['password'])): ?>
        <div class="error" role="alert"><?= htmlspecialchars($errors['password']) ?></div>
      <?php endif; ?>

      <label for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="8" />
      <?php if (isset($errors['confirm_password'])): ?>
        <div class="error" role="alert"><?= htmlspecialchars($errors['confirm_password']) ?></div>
      <?php endif; ?>

      <button type="submit">Sign Up</button>
    </form>

    <div class="footer-text">
      Already have an account? <a href="login.php">Log in</a>
    </div>
  </main>
</body>
</html>

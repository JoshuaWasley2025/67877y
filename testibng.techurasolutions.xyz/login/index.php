<?php
session_start();
require_once '../db.php'; // <-- Your DB connection file

$company = "JournalJoy";
$pagesubtitle = "Login";
$domain = "https://testing.techurasolutions.xyz/";
$error = '';
$old_email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT id, email, password_hash, full_name FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];

                header("Location: /dashboard/");
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Account not found.";
        }

        $stmt->close();
    } else {
        $error = "Please enter both email and password.";
    }

    $old_email = $email;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo htmlspecialchars($company); ?> | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<div class="flex items-center justify-center min-h-screen px-4">
  <div class="bg-white shadow-xl rounded-lg w-full max-w-md p-8">
    <div class="text-center mb-6">
      <img src="<?php echo $domain; ?>JournalJoy.png" alt="<?php echo $company; ?> Logo" class="h-16 w-16 mx-auto mb-2">
      <h1 class="text-2xl font-bold text-gray-800">Login to JournalJoy</h1>
    </div>

    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-4">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($old_email); ?>"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-6">
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input type="password" id="password" name="password" required minlength="6"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
              class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
        Login
      </button>
    </form>

    <p class="text-sm text-center mt-6 text-gray-600">
      Don’t have an account?
      <a href="/signup/" class="text-blue-600 hover:underline">Sign up here</a>
    </p>
  </div>
</div>

</body>
</html>

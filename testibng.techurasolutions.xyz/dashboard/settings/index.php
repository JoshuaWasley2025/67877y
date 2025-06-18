<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../../db.php'; // Adjust this path if needed

$company = "JournalJoy";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$notification = '';
$error = '';

// Fetch current user info
$stmt = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $email);
if (!$stmt->fetch()) {
    // User not found - logout
    session_destroy();
    header('Location: login.php');
    exit;
}
$stmt->close();

// Handle form submission to update settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_full_name = trim($_POST['full_name'] ?? '');
    $new_email = trim($_POST['email'] ?? '');

    if ($new_full_name === '' || $new_email === '') {
        $error = "Full name and email cannot be empty.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // Update user info in DB
        $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssi", $new_full_name, $new_email, $user_id);
        if ($stmt->execute()) {
            $notification = "Settings updated successfully.";
            $full_name = $new_full_name;
            $email = $new_email;
        } else {
            $error = "Failed to update settings.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?php echo htmlspecialchars($company); ?> | Settings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="bg-white w-64 shadow-lg min-h-screen hidden md:block">
    <div class="p-6">
      <img src="https://testing.techurasolutions.xyz/JournalJoy.png" alt="<?php echo $company; ?> Logo" class="h-12 mx-auto mb-6" />
      <nav>
        <ul class="space-y-4 text-gray-700">
          <li><a href="dashboard.php" class="block py-2 px-4 rounded hover:bg-blue-100">Dashboard</a></li>
          <li><a href="profile.php" class="block py-2 px-4 rounded hover:bg-blue-100">Profile</a></li>
          <li><a href="settings.php" class="block py-2 px-4 rounded bg-blue-600 text-white font-semibold">Settings</a></li>
          <li><a href="logout.php" class="block py-2 px-4 rounded hover:bg-red-100 text-red-600 font-semibold">Logout</a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8 max-w-3xl mx-auto">
    <header class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Settings</h1>
      <p class="text-gray-600">Update your account information below.</p>
    </header>

    <?php if ($notification): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        <?php echo htmlspecialchars($notification); ?>
      </div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded shadow">
      <label for="full_name" class="block font-semibold text-gray-700 mb-1">Full Name</label>
      <input
        type="text"
        id="full_name"
        name="full_name"
        value="<?php echo htmlspecialchars($full_name); ?>"
        required
        class="w-full mb-4 p-2 border rounded"
      />

      <label for="email" class="block font-semibold text-gray-700 mb-1">Email Address</label>
      <input
        type="email"
        id="email"
        name="email"
        value="<?php echo htmlspecialchars($email); ?>"
        required
        class="w-full mb-4 p-2 border rounded"
      />

      <button
        type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
      >Save Changes</button>
    </form>
  </main>

</body>
</html>

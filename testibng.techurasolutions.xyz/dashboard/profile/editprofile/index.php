<?php
session_start();
require_once '../../db.php';

$company = "JournalJoy";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Session ID is not set";  // Debugging output
    header('Location: ../login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// CSRF token setup
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Fetch the current profile information from the database
$stmt = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $email);

// Check if data was fetched
if (!$stmt->fetch()) {
    echo "No data found for user ID: $user_id";  // Debugging output
    session_destroy();
    header('Location: ../login.php');
    exit;
}
$stmt->close();

// Initialize notification message
$notification = '';
$notification_type = 'info';

// CSRF validation function
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
        $notification_type = 'error';
        $notification = 'Invalid CSRF token.';
    } else {
        if (isset($_POST['full_name'], $_POST['email'])) {
            $new_full_name = trim($_POST['full_name']);
            $new_email = trim($_POST['email']);

            // Basic validation for empty fields
            if ($new_full_name === '' || $new_email === '') {
                $notification = "Full name and email cannot be empty.";
                $notification_type = 'error';
            } else {
                // Sanitize email before updating
                if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                    $notification = "Invalid email format.";
                    $notification_type = 'error';
                } else {
                    // Update the user's profile info
                    $updateStmt = $conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?");
                    $updateStmt->bind_param("ssi", $new_full_name, $new_email, $user_id);
                    if ($updateStmt->execute()) {
                        $notification = "Profile updated successfully!";
                        $notification_type = 'success';
                    } else {
                        $notification = "Failed to update profile.";
                        $notification_type = 'error';
                    }
                    $updateStmt->close();
                }
            }
        }
    }
}

include '../includes/header.php';
?>

<main class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Edit Profile</h1>
        <a href="../profile.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Back to Profile</a>
    </div>

    <!-- Notification Message -->
    <?php if ($notification): ?>
        <?php
        $bgColor = 'bg-blue-100 border-blue-400 text-blue-800';
        if ($notification_type === 'success') {
            $bgColor = 'bg-green-100 border-green-400 text-green-800';
        } elseif ($notification_type === 'error') {
            $bgColor = 'bg-red-100 border-red-400 text-red-800';
        }
        ?>
        <div class="mb-6 px-4 py-3 border rounded <?= $bgColor ?>">
            <strong class="capitalize"><?= htmlspecialchars($notification_type) ?>:</strong> <?= htmlspecialchars($notification) ?>
        </div>
    <?php endif; ?>

    <!-- Profile Edit Form -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Update Profile</h2>
        <form method="POST" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            
            <!-- Full Name Input -->
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($full_name) ?>" class="w-full border rounded p-2" required>
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" class="w-full border rounded p-2" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
        </form>
    </div>
</main>

<?php include '../includes/footer.php'; ?>

<?php
require_once '../../db.php'; // Make sure path is correct

$token = $_GET['token'] ?? '';
$message = '';

if (!$token) {
    $message = "Invalid verification link.";
} else {
    $stmt = $conn->prepare("
        SELECT ev.id, ev.user_id, ev.expires_at, ev.verified, u.email 
        FROM email_verifications ev 
        JOIN users u ON ev.user_id = u.id 
        WHERE ev.token = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $message = "Invalid or expired verification link.";
    } else {
        $row = $result->fetch_assoc();

        if ($row['verified']) {
            $message = "Email already verified.";
        } elseif (strtotime($row['expires_at']) < time()) {
            $message = "Verification link has expired.";
        } else {
            // Mark email as verified
            $update = $conn->prepare("UPDATE email_verifications SET verified = 1 WHERE id = ?");
            $update->bind_param("i", $row['id']);
            $update->execute();

            $message = "Your email (" . htmlspecialchars($row['email']) . ") has been successfully verified!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Verification | JournalJoy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full text-center">
    <img src="https://testing.techurasolutions.xyz/JournalJoy.png" alt="Logo" class="h-16 mx-auto mb-4">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Email Verification</h1>
    <p class="text-gray-700 text-base"><?php echo $message; ?></p>

    <div class="mt-6">
      <a href="login.php" class="text-blue-600 hover:underline">Back to Login</a>
    </div>
  </div>
</body>
</html>

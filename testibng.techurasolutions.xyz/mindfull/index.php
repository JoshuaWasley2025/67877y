<?php
session_start();
require_once '../db.php';

$company = "JournalJoy";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Generate CSRF token for form security
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Fetch user info
$stmt = $conn->prepare("SELECT full_name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $email);
if (!$stmt->fetch()) {
    session_destroy();
    header('Location: login.php');
    exit;
}
$stmt->close();

$notification = '';
$notification_type = 'info'; // 'success', 'error', 'info'

// Validate CSRF token helper function
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Handle new journal entry
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check CSRF token
    if (!isset($_POST['csrf_token']) || !validate_csrf_token($_POST['csrf_token'])) {
    } else {
        // Add new journal entry
        if (isset($_POST['journal_title'], $_POST['journal_content'])) {
            $title = trim($_POST['journal_title']);
            $content = trim($_POST['journal_content']);

            if ($title === '' || $content === '') {
                $notification = "Title and content cannot be empty.";
                $notification_type = 'error';
            } else {
                // Check for duplicate entry
                $checkStmt = $conn->prepare("SELECT id FROM journals WHERE user_id = ? AND title = ? AND content = ?");
                $checkStmt->bind_param("iss", $user_id, $title, $content);
                $checkStmt->execute();
                $checkStmt->store_result();

                if ($checkStmt->num_rows > 0) {
                    $notification = "This journal entry already exists.";
                    $notification_type = 'error';
                } else {
                    $insertStmt = $conn->prepare("INSERT INTO journals (user_id, title, content) VALUES (?, ?, ?)");
                    $insertStmt->bind_param("iss", $user_id, $title, $content);
                    if ($insertStmt->execute()) {
                        $notification = "Journal entry added successfully!";
                        $notification_type = 'success';
                    } else {
                        $notification = "Failed to add journal entry.";
                        $notification_type = 'error';
                    }
                    $insertStmt->close();
                }
                $checkStmt->close();
            }
        }

        // Delete journal entry
        elseif (isset($_POST['delete_entry_id'])) {
            $delete_id = intval($_POST['delete_entry_id']);
            $deleteStmt = $conn->prepare("DELETE FROM journals WHERE id = ? AND user_id = ?");
            $deleteStmt->bind_param("ii", $delete_id, $user_id);
            if ($deleteStmt->execute()) {
                $notification = "Journal entry deleted.";
                $notification_type = 'success';
            } else {
                $notification = "Failed to delete entry.";
                $notification_type = 'error';
            }
            $deleteStmt->close();
        }

        // Edit journal entry
        elseif (isset($_POST['edit_entry_id'], $_POST['edit_journal_title'], $_POST['edit_journal_content'])) {
            $edit_id = intval($_POST['edit_entry_id']);
            $edit_title = trim($_POST['edit_journal_title']);
            $edit_content = trim($_POST['edit_journal_content']);

            if ($edit_title === '' || $edit_content === '') {
                $notification = "Title and content cannot be empty.";
                $notification_type = 'error';
            } else {
                $updateStmt = $conn->prepare("UPDATE journals SET title = ?, content = ? WHERE id = ? AND user_id = ?");
                $updateStmt->bind_param("ssii", $edit_title, $edit_content, $edit_id, $user_id);
                if ($updateStmt->execute()) {
                    $notification = "Journal entry updated successfully.";
                    $notification_type = 'success';
                } else {
                    $notification = "Failed to update entry.";
                    $notification_type = 'error';
                }
                $updateStmt->close();
            }
        }
    }
}

// Fetch journals
$stmt = $conn->prepare("SELECT id, title, content, created_at FROM journals WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$journals = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$entryCount = count($journals);
$lastEntry = $entryCount > 0 ? date("F j, Y", strtotime($journals[0]['created_at'])) : "No entries yet";
?>

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

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($company) ?> | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        textarea { resize: vertical; min-height: 80px; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex font-sans text-gray-800">

<!-- Sidebar -->
<aside class="bg-white w-64 shadow-lg min-h-screen hidden md:flex flex-col" role="navigation" aria-label="Sidebar navigation">
    <div class="p-6 text-center">
        <img src="https://testing.techurasolutions.xyz/JournalJoy.png" alt="JournalJoy Logo" class="h-12 mb-4 mx-auto" />
        <nav>
            <ul class="space-y-3 text-gray-700 font-medium">
                <li><a href="../dashboard" class="block py-2 px-4 bg-blue-600 text-white rounded" aria-current="page">Dashboard</a></li>
                <li><a href="../profile" class="block py-2 px-4 hover:bg-blue-100 rounded">Profile</a></li>
                <li><a href="../settings" class="block py-2 px-4 hover:bg-blue-100 rounded">Settings</a></li>
                <li><a href="../support" class="block py-2 px-4 hover:bg-blue-100 rounded">Support</a></li>
                <li><a href="/logout" class="block py-2 px-4 hover:bg-red-100 text-red-600 font-semibold rounded">Logout</a></li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 p-8 max-w-7xl mx-auto w-full" role="main">
    <header class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
        <h1 class="text-4xl font-extrabold" tabindex="0">Welcome, <span class="text-blue-600"><?= htmlspecialchars($full_name) ?></span></h1>
            <p class="text-gray-500"><?= $greetingMessage ?>!</p>
        <a href="/profile" class="text-blue-600 font-semibold hover:underline">View Profile</a>
    </header>

    <?php if ($notification): ?>
        <?php
        $bgColor = 'bg-blue-50 border-blue-400 text-blue-800';
        if ($notification_type === 'success') {
            $bgColor = 'bg-green-50 border-green-400 text-green-800';
        } elseif ($notification_type === 'error') {
            $bgColor = 'bg-red-50 border-red-400 text-red-800';
        }
        ?>
        <div class="mb-6 px-4 py-3 rounded border <?= $bgColor ?>" role="alert" aria-live="polite" aria-atomic="true">
            <strong class="capitalize"><?= htmlspecialchars($notification_type) ?>:</strong> <?= htmlspecialchars($notification) ?>
        </div>
    <?php endif; ?>

    <!-- Summary -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10" aria-label="User summary and stats">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Account Info</h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($full_name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Account ID:</strong> <?= htmlspecialchars($user_id) ?></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Journal Stats</h2>
            <p><strong>Total Entries:</strong> <?= $entryCount ?></p>
            <p><strong>Last Entry:</strong> <?= $lastEntry ?></p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Activity Log</h2>
            <p class="text-sm text-gray-500">Recent activities will be displayed here</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Comments</h2>
            <p class="text-sm text-gray-500">Comments will be displayed here</p>
    </div>
        <div class="bg-white rounded-lg shadow p-6">
			        <h2 class="text-xl font-semibold text-gray-700 mb-4">Other Links</h2>
            <p class="text-sm text-gray-500">Find All Your Links Here!</p>
		</div>
    </section>

    <!-- New Journal Entry -->
    <section>
        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4">New Journal Entry</h2>
            <form method="POST" class="space-y-3" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>" />
                <label for="journal_title" class="sr-only">Journal Title</label>
                <input
                    type="text" id="journal_title" name="journal_title" placeholder="Title" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-required="true"
                />
                <label for="journal_content" class="sr-only">Journal Content</label>
                <textarea
                    id="journal_content" name="journal_content" placeholder="Write something..." required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-required="true"
                ></textarea>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700"
                >Add Entry</button>
            </form>
        </div>

        <?php if ($entryCount > 0): ?>
            <h2 class="text-2xl font-bold mb-4">Your Entries</h2>
            <ul class="space-y-6">
                <?php foreach ($journals as $entry): ?>
                    <li class="bg-white border rounded p-4 shadow" aria-label="Journal entry titled <?= htmlspecialchars($entry['title']) ?>">
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-lg"><?= htmlspecialchars($entry['title']) ?></h3>
                            <div class="space-x-3">
                                <button
                                    type="button"
                                    onclick="toggleEdit(<?= (int)$entry['id'] ?>)"
                                    class="text-blue-600 hover:underline"
                                    aria-expanded="false"
                                    aria-controls="edit-<?= (int)$entry['id'] ?>"
                                >Edit</button>
                                <form method="POST" class="inline" onsubmit="return confirm('Delete this entry?');" aria-label="Delete journal entry">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>" />
                                    <input type="hidden" name="delete_entry_id" value="<?= (int)$entry['id'] ?>" />
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p class="whitespace-pre-wrap mt-2"><?= nl2br(htmlspecialchars($entry['content'])) ?></p>
                        <small class="text-gray-500 block mt-2"><?= htmlspecialchars($entry['created_at']) ?></small>

                        <!-- Edit form -->
                        <form method="POST" id="edit-<?= (int)$entry['id'] ?>" class="hidden mt-4 space-y-2" aria-label="Edit journal entry form">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>" />
                            <input type="hidden" name="edit_entry_id" value="<?= (int)$entry['id'] ?>" />
                            <input
                                type="text" name="edit_journal_title" value="<?= htmlspecialchars($entry['title']) ?>" required
                                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                                aria-required="true"
                            />
                            <textarea
                                name="edit_journal_content" required
                                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-500"
                                aria-required="true"
                            ><?= htmlspecialchars($entry['content']) ?></textarea>
                            <button
                                type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-700"
                            >Save Changes</button>
                            <button type="button" onclick="toggleEdit(<?= (int)$entry['id'] ?>)" class="ml-2 text-gray-500 hover:text-gray-800">Cancel</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center text-gray-600 mt-10">You have no journal entries yet.</p>
        <?php endif; ?>
    </section>
</main>

<script>
function toggleEdit(id) {
    const form = document.getElementById('edit-' + id);
    if (!form) return;
    const isHidden = form.classList.contains('hidden');
    form.classList.toggle('hidden', !isHidden);

    // Update aria-expanded attribute on edit button
    const editButton = form.previousElementSibling.querySelector('button[aria-expanded]');
    if (editButton) {
        editButton.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    }
}
</script>

</body>
</html>

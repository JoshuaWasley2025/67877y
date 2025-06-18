<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JournalJoy | Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Dropdown animation */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.2s ease-out;
        }
        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold text-purple-600">JournalJoy</div>
            <div class="relative group">
                <button class="flex items-center space-x-2 focus:outline-none">
                    <img src="<?= $user['profile_pic'] ?? 'https://via.placeholder.com/40' ?>" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    <span class="hidden sm:block text-gray-700">Hi, <strong><?= htmlspecialchars($user['name']) ?></strong></span>
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 hidden group-hover:block bg-white border shadow-lg rounded w-48 z-50 transition-all dropdown-enter">
                    <a href="dashboard.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="edit_profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                    <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Content -->
    <main class="max-w-4xl mx-auto mt-12 bg-white p-8 rounded-lg shadow">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Your Profile</h1>
        <div class="flex flex-col md:flex-row items-center gap-8">
            <img src="<?= $user['profile_pic'] ?? 'https://via.placeholder.com/120' ?>" alt="Profile Picture" class="w-36 h-36 rounded-full object-cover border-4 border-purple-500 shadow-md">
            <div class="text-lg text-gray-700 space-y-3">
                <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Joined:</strong> <?= htmlspecialchars($user['joined_at'] ?? 'Unknown') ?></p>
            </div>
        </div>
    </main>

</body>
</html>

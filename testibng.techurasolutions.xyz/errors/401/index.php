<?php 
$website_title = "401 Unauthorized";
$company = "Journal Joy";
$favicon_url = "./JournalJoy.png";
$redirect_seconds = 10;
$redirect_url = "/login";
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($company) . " | " . htmlspecialchars($website_title); ?></title>
  <link rel="icon" href="<?= htmlspecialchars($favicon_url); ?>" type="image/png" />

  <!-- Tailwind CSS & Fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <meta http-equiv="refresh" content="<?= $redirect_seconds; ?>;url=<?= $redirect_url; ?>">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
      color: #1e293b;
      margin: 0;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-x: hidden;
    }

    main {
      flex-grow: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem 1.5rem;
      animation: fadeInUp 0.8s ease forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .underline-animated {
      position: relative;
      display: inline-block;
      padding-bottom: 6px;
      cursor: default;
    }

    .underline-animated::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, #fb923c, #f97316);
      border-radius: 9999px;
      animation: slideGradient 3s linear infinite;
    }

    @keyframes slideGradient {
      0% {
        background-position: 0% 50%;
      }
      100% {
        background-position: 200% 50%;
      }
    }
  </style>
</head>
<body>

<main>
  <section class="max-w-lg w-full bg-white rounded-3xl shadow-2xl p-10 text-center">
    <div class="mb-8">
      <ph-icon name="lock" weight="fill" class="mx-auto text-orange-500 w-24 h-24 animate-pulse"></ph-icon>
    </div>

    <h1 class="text-8xl font-extrabold text-slate-900 mb-3 underline-animated">401</h1>
    <h2 class="text-3xl font-semibold mb-6 text-gray-700">Unauthorized Access</h2>

    <p class="text-gray-600 mb-8 leading-relaxed">
      You do not have permission to view this page.<br>
      You will be redirected to the login page in <?= $redirect_seconds; ?> seconds.
    </p>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="/login" class="px-6 py-3 bg-orange-500 text-white rounded-full font-semibold shadow-md hover:bg-orange-600 transition duration-200">
        Go to Login
      </a>
      <a href="/" class="px-6 py-3 bg-gray-100 text-slate-700 rounded-full font-semibold shadow-md hover:bg-gray-200 transition duration-200">
        Return Home
      </a>
    </div>

    <p class="text-xs text-gray-400 mt-6 select-none">
      Error Timestamp: <?= date("Y-m-d H:i:s"); ?>
    </p>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <div class="mt-4 text-sm text-green-600 bg-green-100 p-3 rounded-lg">
      You are logged in as <strong>Admin</strong>. If you're seeing this page by mistake, check access control.
    </div>
    <?php endif; ?>
  </section>
</main>

<footer class="bg-transparent text-center text-sm text-white/80 py-6 select-none">
  &copy; <?= date("Y"); ?> <span class="font-semibold"><?= htmlspecialchars($company); ?></span>. All rights reserved.
</footer>

</body>
</html>

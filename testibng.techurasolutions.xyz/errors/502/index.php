<?php 
$website_title = "502 Bad Gateway";
$company = "Journal Joy";
$favicon_url = "./JournalJoy.png";
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

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
      background: linear-gradient(90deg, #f87171, #fca5a5);
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
      <ph-icon name="cloud-warning" weight="duotone" class="mx-auto text-red-500 w-24 h-24 animate-pulse"></ph-icon>
    </div>

    <h1 class="text-7xl font-extrabold text-slate-900 mb-3 underline-animated">502</h1>
    <h2 class="text-2xl font-semibold mb-6 text-gray-700">Bad Gateway</h2>

    <p class="text-gray-600 mb-8 leading-relaxed">
      The server received an invalid response from an upstream server. Please try again later or contact support if the issue persists.
    </p>

    <div class="flex flex-wrap justify-center gap-4">
      <a href="/" class="px-6 py-3 bg-red-600 text-white rounded-full font-semibold shadow-md hover:bg-red-700 transition">Return Home</a>
      <a href="/support" class="px-6 py-3 bg-gray-100 text-slate-700 rounded-full font-semibold shadow-md hover:bg-gray-200 transition">Get Help</a>
    </div>

    <p class="text-xs text-gray-400 mt-6 select-none">
      Error Timestamp: <?= date("Y-m-d H:i:s"); ?>
    </p>
  </section>
</main>

<footer class="bg-transparent text-center text-sm text-white/80 py-6 select-none">
  &copy; <?= date("Y"); ?> <span class="font-semibold"><?= htmlspecialchars($company); ?></span>. All rights reserved.
</footer>

</body>
</html>
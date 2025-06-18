<?php 
$website_title = "500 Internal Server Error";
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
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: #1e293b;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
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
      background: linear-gradient(90deg, #f87171, #facc15);
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

    input[type="search"] {
      transition: box-shadow 0.3s ease;
    }

    input[type="search"]:focus {
      outline: none;
      box-shadow: 0 0 8px 2px #ef4444;
    }
  </style>
</head>
<body>

  <main>
    <section class="max-w-lg bg-white rounded-3xl shadow-2xl p-10 text-center">
      <div class="mb-8">
        <ph-icon name="fire" weight="fill" class="mx-auto text-red-600 w-24 h-24"></ph-icon>
      </div>

      <h1 class="text-8xl font-extrabold text-slate-900 select-none mb-3 underline-animated">500</h1>
      <h2 class="text-3xl font-semibold mb-6 text-gray-700">Something went wrong</h2>
      <p class="text-gray-600 mb-8 leading-relaxed">
        Our servers are having a rough day. Please bear with us while we resolve the issue. You can try again shortly or head back to a safe place.
      </p>

      <!-- Quick links -->
      <nav aria-label="Quick navigation" class="flex flex-wrap justify-center gap-4">
        <a href="/" class="px-6 py-3 bg-red-600 text-white rounded-full font-semibold shadow-md hover:bg-red-700 transition">Home</a>
        <a href="/support" class="px-6 py-3 bg-gray-100 text-slate-700 rounded-full font-semibold shadow-md hover:bg-gray-200 transition">Support</a>
        <a href="/status" class="px-6 py-3 bg-gray-100 text-slate-700 rounded-full font-semibold shadow-md hover:bg-gray-200 transition">Status Page</a>
      </nav>

      <p class="text-xs text-gray-400 mt-6 select-none">Error Timestamp: <?= date("Y-m-d H:i:s"); ?></p>
    </section>
  </main>

  <footer class="bg-white text-center py-6 select-none text-sm text-slate-500 border-t border-gray-300">
    &copy; <?= date("Y"); ?> <span class="font-semibold"><?= htmlspecialchars($company); ?></span>. All rights reserved.
  </footer>

</body>
</html>

<?php 
$website_title = "Maintenance Mode";
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

  <!-- Tailwind CSS + Fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #facc15, #fb923c);
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

    .glow {
      text-shadow: 0 0 6px rgba(234, 179, 8, 0.3);
    }
  </style>
</head>
<body>

<main role="main">
  <section class="bg-white max-w-xl w-full p-10 rounded-3xl shadow-2xl text-center">
    <div class="mb-6">
      <ph-icon name="wrench" weight="duotone" class="mx-auto text-yellow-500 w-20 h-20"></ph-icon>
    </div>

    <h1 class="text-5xl font-extrabold text-slate-900 mb-4 glow">Under Maintenance</h1>
    <p class="text-lg text-gray-600 leading-relaxed mb-6">
      We're performing some scheduled updates to improve your experience.<br>
      Thanks for your patience. We'll be back shortly.
    </p>

    <a href="/" class="inline-block mt-2 px-6 py-3 bg-yellow-500 text-white rounded-full font-semibold shadow-md hover:bg-yellow-600 transition duration-200">
      Back to Home
    </a>

    <p class="text-xs text-gray-400 mt-6 select-none">
      Last updated: <?= date("F j, Y, g:i a"); ?>
    </p>
  </section>
</main>

<footer class="text-center text-sm text-white/80 py-6 select-none">
  &copy; <?= date("Y"); ?> <span class="font-semibold"><?= htmlspecialchars($company); ?></span>. All rights reserved.
</footer>

</body>
</html>

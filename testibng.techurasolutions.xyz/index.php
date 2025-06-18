<?php 
$website_title = "Home";
$company = "Journal Joy";
$favicon_url = ".\JournalJoy.png"; // Using same logo as favicon for demo
$licenced_to = "Journal Joy"; // Add your licensed-to name here
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($company) . " | " . htmlspecialchars($website_title); ?></title>
  
  <!-- Favicon -->
  <link rel="icon" href="<?php echo $favicon_url; ?>" type="image/png" />
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
  
  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Loader */
    #loader {
      position: fixed;
      width: 100vw;
      height: 100vh;
      background: white;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    #loader.fade-out {
      opacity: 0;
      visibility: hidden;
      pointer-events: none;
    }

    .loader-icon {
      border: 4px solid #e0e0e0;
      border-top: 4px solid #3b82f6; /* Tailwind's blue-500 */
      border-radius: 50%;
      width: 48px;
      height: 48px;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    /* Navbar styles */
    nav a, nav button {
      transition: color 0.3s ease, background-color 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem; /* rounded-md */
      font-weight: 600;
      color: #374151; /* gray-700 */
    }

    nav a:hover, nav button:hover {
      color: white;
      background-color: #2563eb; /* blue-600 */
    }

    /* Dropdown */
    .dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background: white;
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
      border-radius: 0.375rem;
      overflow: hidden;
      min-width: 180px;
      z-index: 50;
      opacity: 0;
      transform: translateY(10px);
      pointer-events: none;
      transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .dropdown:hover .dropdown-menu,
    .dropdown:focus-within .dropdown-menu {
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }

    .dropdown-menu a {
      display: block;
      padding: 0.5rem 1rem;
      color: #374151;
      font-weight: 500;
      transition: background-color 0.2s ease;
    }

    .dropdown-menu a:hover {
      background-color: #2563eb;
      color: white;
    }

    /* Mobile menu */
    #mobile-menu {
      display: none;
    }

    @media (max-width: 768px) {
      #desktop-menu {
        display: none;
      }
      #mobile-menu {
        display: block;
      }
    }
  </style>

  <script>
    // Loader fade out
    window.addEventListener("load", () => {
      const loader = document.getElementById("loader");
      loader.classList.add("fade-out");
    });

    // Toggle mobile menu
    function toggleMobileMenu() {
      const menu = document.getElementById("mobile-menu");
      if (menu.style.display === "block") {
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Loader -->
  <div id="loader">
    <div class="loader-icon" role="status" aria-label="Loading"></div>
  </div>

  <!-- Header / Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="flex items-center gap-3">
        <img src="<?php echo $favicon_url; ?>" alt="Journal Joy Logo" class="h-10 w-auto" />
        <h1 class="text-2xl font-extrabold text-blue-600 select-none"><?php echo htmlspecialchars($company); ?></h1>
      </a>

      <!-- Desktop Menu -->
      <div id="desktop-menu" class="hidden md:flex gap-6 text-sm font-semibold text-gray-700 items-center">
        <a href="#" class="rounded-md hover:bg-blue-600 hover:text-white">Home</a>
        <a href="/dashboard" class="rounded-md hover:bg-blue-600 hover:text-white">Dashboard</a>
        <a href="/login" class="rounded-md hover:bg-blue-600 hover:text-white">Login</a>
        <a href="#" class="rounded-md hover:bg-blue-600 hover:text-white">Profile</a>

        <div class="relative dropdown">
          <button class="flex items-center gap-1 rounded-md hover:bg-blue-600 hover:text-white" aria-haspopup="true" aria-expanded="false" type="button">
            More <ph-icon name="caret-down" weight="bold" class="w-4 h-4"></ph-icon>
          </button>
          <div class="dropdown-menu">
            <a href="#" tabindex="0">Settings</a>
            <a href="#" tabindex="0">Help Center</a>
            <a href="#" tabindex="0">Logout</a>
          </div>
        </div>
      </div>

      <!-- Mobile Hamburger -->
      <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-blue-600" aria-label="Toggle menu" onclick="toggleMobileMenu()">
        <ph-icon name="list" weight="bold" class="w-6 h-6"></ph-icon>
      </button>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 shadow-lg" style="display:none;">
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Home</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Dashboard</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Create</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Profile</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Settings</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Help Center</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b border-gray-100">Logout</a>
    </div>
  </header>

<!-- Main Content -->
<main class="max-w-4xl mx-auto px-6 py-12">
  <section class="bg-white shadow-xl rounded-2xl p-8 mb-12 transition-all duration-500 ease-in-out">

    <h1 id="greetingMessage" class="text-2xl font-semibold text-gray-800 mb-2">
      <span class="inline-block animate-fade-in">
        <?php include __DIR__ . '\src\greeting.php'; ?>
      </span>
    </h1>

    <!-- Welcome Heading -->
    <h2 class="text-3xl font-bold text-slate-800 mb-4">
      Welcome to <?= htmlspecialchars($company); ?>
    </h2>

    <!-- Description -->
    <p class="text-slate-600 leading-relaxed text-lg">
      <?= htmlspecialchars($company); ?> is a modern journal management platform that helps you capture, reflect, and grow. Whether you're jotting down daily notes, tracking your goals, or reflecting on life, <strong><?= htmlspecialchars($company); ?></strong> makes it easy and enjoyable.
    </p>
  </section>
  </section>
    <section class="grid md:grid-cols-2 gap-8">
      <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-semibold text-blue-600 mb-3">Why Choose Journal Joy?</h3>
        <ul class="space-y-2 text-gray-700 list-disc pl-5">
          <li>Clean and intuitive design</li>
          <li>Secure and private journaling</li>
          <li>Powerful search and tag system</li>
          <li>Auto-save & version history</li>
        </ul>
      </div>
      <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6">
        <h3 class="text-xl font-semibold text-blue-700 mb-3">Getting Started</h3>
        <p class="text-gray-700">
          Begin by creating your first journal. Explore features like tagging, filtering, and markdown support. Join our community to share ideas and improve your journaling practice.
        </p>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <div class="bg-white text-gray-700 mt-12 border-t border-gray-300">
      <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">About <?php echo htmlspecialchars($company); ?></h4>
          <p class="text-sm text-gray-600">Journal Joy empowers you to take control of your thoughts with a beautiful, easy-to-use platform designed for reflection, planning, and growth.</p>
        </div>
        <div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Quick Links</h4>
          <ul class="space-y-2 text-sm text-gray-600">
            <li><a href="/dashboard" class="hover:underline hover:text-blue-600">Dashboard</a></li>
            <li><a href="/login" class="hover:underline hover:text-blue-600">Login</a></li>
            <li><a href="#" class="hover:underline hover:text-blue-600">Community</a></li>
            <li><a href="#" class="hover:underline hover:text-blue-600">Support</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold text-lg mb-3 text-gray-900">Connect with Us</h4>
          <div class="flex space-x-4 text-gray-700">
            <a href="#" aria-label="Twitter" class="hover:text-blue-400"><ph-icon name="brand-twitter" weight="bold" class="w-6 h-6"></ph-icon></a>
            <a href="#" aria-label="Facebook" class="hover:text-blue-600"><ph-icon name="brand-facebook" weight="bold" class="w-6 h-6"></ph-icon></a>
            <a href="#" aria-label="Instagram" class="hover:text-pink-500"><ph-icon name="brand-instagram" weight="bold" class="w-6 h-6"></ph-icon></a>
          </div>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="border-t border-gray-300 py-5 px-8 flex flex-col md:flex-row items-center justify-between space-y-2 md:space-y-0 select-none text-gray-500 text-sm">
        <p class="text-center md:text-left">
          &copy; <?php echo date("Y"); ?> <span class="font-semibold"><?php echo htmlspecialchars($company); ?></span>. All rights reserved. Unauthorized reproduction is prohibited.
        </p>
        <p class="text-center md:text-right">Licensed to <span class="font-semibold"><?php echo htmlspecialchars($licenced_to); ?></span></p>
      </div>
    </div>
  </footer>
  
</body>
</html>

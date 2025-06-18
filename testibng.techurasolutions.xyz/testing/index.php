<?php 

$website_title = "Home";
$company = "Journal Joy";
$favicon_url = "https://testing.techurasolutions.xyz/JournalJoy.png"; // Using same logo as favicon for demo
?>

<!--
     _                              _       _             
    | | ___  _   _ _ __ _ __   __ _| |     | | ___  _   _ 
 _  | |/ _ \| | | | '__| '_ \ / _` | |  _  | |/ _ \| | | |
| |_| | (_) | |_| | |  | | | | (_| | | | |_| | (_) | |_| |
 \___/ \___/ \__,_|_|  |_| |_|\__,_|_|  \___/ \___/ \__, |
                                                    |___/ 
-->

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

    /* Navbar transitions and mobile toggle */
    nav a, nav button {
      transition: color 0.3s ease;
    }

    nav a:hover, nav button:hover {
      color: #2563eb; /* blue-600 */
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
  <header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="flex items-center gap-3">
        <img src="<?php echo $favicon_url; ?>" alt="Journal Joy Logo" class="h-10 w-auto" />
        <h1 class="text-2xl font-extrabold text-blue-600 select-none"><?php echo htmlspecialchars($company); ?></h1>
      </a>

      <!-- Desktop Menu -->
      <div id="desktop-menu" class="hidden md:flex gap-8 text-sm font-semibold text-gray-700">
        <a href="#" class="hover:text-blue-600">Home</a>
        <a href="#" class="hover:text-blue-600">Dashboard</a>
        <a href="#" class="hover:text-blue-600">Create</a>
        <a href="#" class="hover:text-blue-600">Profile</a>
        <div class="relative group">
          <button class="hover:text-blue-600 flex items-center gap-1" aria-haspopup="true" aria-expanded="false">
            More <ph-icon name="caret-down" weight="bold" class="w-4 h-4"></ph-icon>
          </button>
          <div class="absolute hidden group-hover:block mt-2 w-44 bg-white shadow-lg rounded-md text-sm text-gray-700">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Help Center</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
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
    <section class="bg-white shadow-lg rounded-xl p-8 mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome to <?php echo htmlspecialchars($company); ?></h2>
      <p class="text-gray-600 leading-relaxed">
        <?php echo htmlspecialchars($company); ?> is a modern journal management platform that helps you capture, reflect, and grow. Whether you're jotting down daily notes, tracking your goals, or reflecting on life, Journal Joy makes it easy and enjoyable.
      </p>
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
  <footer class="bg-gradient-to-tr from-blue-800 to-indigo-900 text-white mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h4 class="font-bold text-lg mb-3">About <?php echo htmlspecialchars($company); ?></h4>
        <p class="text-sm text-gray-300">Journal Joy empowers you to take control of your thoughts with a beautiful, easy-to-use platform designed for reflection, planning, and growth.</p>
      </div>
      <div>
        <h4 class="font-bold text-lg mb-3">Quick Links</h4>
        <ul class="space-y-2 text-sm text-gray-300">
          <li><a href="#" class="hover:underline">Dashboard</a></li>
          <li><a href="#" class="hover:underline">Create Journal</a></li>
          <li><a href="#" class="hover:underline">Community</a></li>
          <li><a href="#" class="hover:underline">Support</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-bold text-lg mb-3">Connect with Us</h4>
        <div class="flex space-x-4">
          <a href="#" aria-label="Twitter" class="hover:text-blue-300 text-xl"><ph-icon name="twitter-logo"></ph-icon></a>
          <a href="#" aria-label="Instagram" class="hover:text-pink-400 text-xl"><ph-icon name="instagram-logo"></ph-icon></a>
          <a href="#" aria-label="Github" class="hover:text-gray-400 text-xl"><ph-icon name="github-logo"></ph-icon></a>
          <a href="#" aria-label="Email" class="hover:text-blue-200 text-xl"><ph-icon name="envelope-simple"></ph-icon></a>
        </div>
      </div>
    </div>
    <div class="border-t border-blue-700 mt-6 text-center text-xs py-4 text-gray-400 select-none">
      &copy; <?php echo date("Y"); ?> <?php echo htmlspecialchars($company); ?>. All rights reserved. | Designed with ❤️ by Journal Joy
    </div>
  </footer>

</body>
</html>

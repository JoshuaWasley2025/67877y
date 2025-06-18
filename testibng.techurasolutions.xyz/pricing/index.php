<?php 
$website_title = "Pricing";
$company = "Journal Joy";
$favicon_url = "https://testing.techurasolutions.xyz/JournalJoy.png"; // Using same logo as favicon for demo
$licenced_to = "Journal Joy"; // Add your licensed-to name here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo htmlspecialchars($company) . " - " . htmlspecialchars($website_title); ?></title> 

  <!-- Favicon -->
  <link rel="icon" href="..\JournalJoy.png" type="image/png" />

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />

  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/regular/style.css" />

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
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
      border-top: 4px solid #3b82f6;
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
    nav a, nav button {
      transition: color 0.3s ease, background-color 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 600;
      color: #374151;
    }
    nav a:hover, nav button:hover {
      color: white;
      background-color: #ffffff;
    }
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
    window.addEventListener("load", () => {
      const loader = document.getElementById("loader");
      loader.classList.add("fade-out");
      const yearSpan = document.getElementById("current-year");
      if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
      }
    });

    function toggleMobileMenu() {
      const menu = document.getElementById("mobile-menu");
      if (menu.style.display === "block") {
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    }

    function toggleFeatures() {
      const extras = document.querySelectorAll('.feature-extra');
      const btn = document.getElementById('view-more-btn');
      const isHidden = extras[0].classList.contains('hidden');

      extras.forEach(item => {
        if (isHidden) {
          item.classList.remove('hidden');
        } else {
          item.classList.add('hidden');
        }
      });

      btn.textContent = isHidden ? 'View Less' : 'View More';
    }
  </script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div id="loader">
    <div class="loader-icon" role="status" aria-label="Loading"></div>
  </div>

  <header class="bg-white shadow sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="#" class="flex items-center gap-3">
        <img src=".\JournalJoy.png" alt="Journal Joy Logo" class="h-10 w-auto" />
        <h1 class="text-2xl font-extrabold text-blue-600 select-none">Journal Joy</h1>
      </a>
      <div id="desktop-menu" class="hidden md:flex gap-6 text-sm font-semibold text-gray-700 items-center">
        <a href="#" class="rounded-md hover:bg-blue-600 hover:text-white">Home</a>
        <a href="/dashboard" class="rounded-md hover:bg-blue-600 hover:text-white">Dashboard</a>
        <a href="/login" class="rounded-md hover:bg-blue-600 hover:text-white">Login</a>
        <a href="#" class="rounded-md hover:bg-blue-600 hover:text-white">Profile</a>
        <div class="relative dropdown">
          <button class="flex items-center gap-1 rounded-md hover:bg-blue-600 hover:text-white" type="button">
            More <i class="ph ph-caret-down"></i>
          </button>
          <div class="dropdown-menu">
            <a href="#">Settings</a>
            <a href="#">Help Center</a>
            <a href="#">Logout</a>
          </div>
        </div>
      </div>
      <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-blue-600" onclick="toggleMobileMenu()">
        <i class="ph ph-list"></i>
      </button>
    </nav>
    <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 shadow-lg" style="display:none;">
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Home</a>
      <a href="/dashboard" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Dashboard</a>
      <a href="/signup" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Get Started</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Profile</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Settings</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Help Center</a>
      <a href="#" class="block px-6 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-semibold border-b">Logout</a>
    </div>
  </header>

</main>

  <!-- Pricing Section -->
  <section class="py-20 bg-white text-center">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-blue-600 mb-6">Simple, Transparent Pricing</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Free Plan -->
        <div class="border p-6 rounded-lg shadow-sm">
          <h3 class="text-xl font-semibold mb-2">Free Plan</h3>
          <p class="text-4xl font-extrabold mb-4 text-green-600">Free</p>
          <p class="text-gray-600 mb-4">Get started with the basics. Great for beginners.</p>
          <ul class="text-left text-gray-700 space-y-2 mb-6">
            <li>✔️ Unlimited Journal Entries</li>
            <li>✔️ Daily Prompts</li>
            <li>✔️ Basic Analytics</li>
            <li>✔️ Mood Tracking</li>
            <li>✔️ Documentation Access</li>
            <li>✔️ Mobile-Friendly Design</li>
            <li>✔️ Basic Theme Support</li>
            <li>✔️ Secure Login</li>
          </ul>
          <a href="/signup" class="bg-green-600 text-white py-2 px-6 rounded hover:bg-green-700 inline-block">Start Free</a>
        </div>

        <!-- Pro Plan -->
        <div class="border p-6 rounded-lg shadow-lg bg-blue-50 relative">
          <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg select-none">Best Value</div>
          <h3 class="text-xl font-semibold mb-2">Pro Plan</h3>
          <p class="text-4xl font-extrabold mb-4 text-blue-600">$7.99 AUD/mo</p>
          <p class="text-gray-600 mb-4">Advanced features for serious journalers.</p>
          <ul class="text-left text-gray-700 space-y-2 mb-4" id="pro-features-list">
            <li>✔️ Everything in Free</li>
            <li>✔️ Mood Tracking</li>
            <li>✔️ PDF Exports</li>
            <li>✔️ Priority Support</li>
            <li>✔️ Mindfulness Integration</li>

            <!-- Hidden extra features -->
            <li class="hidden feature-extra">✔️ Advanced Analytics & Insights</li>
            <li class="hidden feature-extra">✔️ Full Mood History & Trends</li>
            <li class="hidden feature-extra">✔️ Unlimited Journal Organization (Folders/Tags)</li>
            <li class="hidden feature-extra">✔️ Voice-to-Text Journaling</li>
            <li class="hidden feature-extra">✔️ Custom Themes & Dark Mode</li>
            <li class="hidden feature-extra">✔️ Data Backup & Export (PDF, Markdown, TXT)</li>
            <li class="hidden feature-extra">✔️ AI-Powered Writing Suggestions</li>
            <li class="hidden feature-extra">✔️ End-to-End Encryption</li>
          </ul>
          <button id="view-more-btn" class="text-blue-600 font-semibold hover:underline mb-6" onclick="toggleFeatures()">
            View More
          </button>
          <br />
          <a href="/signup" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700 inline-block">Upgrade Now</a>
        </div>
        <!-- Enterprise Plan -->
<div class="border border-gray-300 p-8 rounded-xl shadow-2xl bg-gray-50 relative max-w-lg mx-auto">
  <!-- Badge -->
  <div class="absolute top-0 right-0 bg-gray-800 text-white text-xs font-semibold px-4 py-1 rounded-bl-xl select-none tracking-wide">
    ENTERPRISE
  </div>

  <!-- Title & Price -->
  <h3 class="text-2xl font-extrabold mb-3 text-gray-900">Enterprise Plan</h3>
  <p class="text-5xl font-extrabold mb-5 text-gray-900">
    $9.99 <span class="text-lg font-normal text-gray-600">AUD/mo</span>
  </p>
  <p class="text-gray-700 mb-8 leading-relaxed">
    Tailored, premium-grade solutions designed for large teams and enterprises seeking advanced features and personalized support.
  </p>

  <!-- Features List -->
  <ul class="text-left text-gray-700 space-y-2 mb-4" id="enterprise-features-list">
    <li>✔️ Everything in Pro Plan</li>
    <li>✔️ Unlimited Team Members & Collaboration</li>
    <li>✔️ Dedicated Account Manager for Personalized Support</li>
    <li>✔️ Custom Integrations & Full API Access</li>
    <li>✔️ Enhanced Security & Compliance (SOC 2, GDPR)</li>
    <li>✔️ Onboarding & Training Sessions</li>
    <li>✔️ Priority Feature Requests & Feedback</li>
    <li>✔️ SLA & 99.99% Uptime Guarantees</li>
    <li>✔️ 24/7 Premium Support with Phone & Chat</li>
    <li>✔️ Advanced Analytics & Custom Reports</li>
  
    <!-- Hidden extra features -->
<li class="hidden feature-extra">✔️ Custom Branding & White Label Options</li>
<li class="hidden feature-extra">✔️ Multi-region Data Hosting & Backup</li>
<li class="hidden feature-extra">✔️ Automated Workflow & Task Management</li>
<li class="hidden feature-extra">✔️ Enterprise-grade Audit Logs</li>
<li class="hidden feature-extra">✔️ Dedicated Security Reviews</li>
<li class="hidden feature-extra">✔️ Flexible Billing & Payment Terms</li>
<li class="hidden feature-extra">✔️ On-premise Deployment Options</li>
<li class="hidden feature-extra">✔️ Monthly Strategy Calls & Business Reviews</li>
<li class="hidden feature-extra">✔️ Custom SLA Agreements Tailored to Your Business Needs</li>
<li class="hidden feature-extra">✔️ Advanced User Role & Permission Controls</li>
<li class="hidden feature-extra">✔️ Dedicated Disaster Recovery Plans</li>
<li class="hidden feature-extra">✔️ Compliance Audits & Reporting (HIPAA, ISO 27001)</li>
<li class="hidden feature-extra">✔️ Scalable Infrastructure with Auto-scaling Capabilities</li>
<li class="hidden feature-extra">✔️ Integration with Enterprise Identity Providers (SSO, LDAP)</li>
<li class="hidden feature-extra">✔️ Personalized Training & Onboarding for Your Teams</li>
<li class="hidden feature-extra">✔️ Cloud Storage</li>
<li class="hidden feature-extra">✔️ Cloud Notes</li>
</ul>

  <button id="view-more-enterprise-btn" class="text-gray-700 font-semibold hover:underline mb-6" onclick="toggleEnterpriseFeatures()">
    View More
  </button>
  <br />
  <a href="/contact" class="bg-gray-700 text-white py-2 px-6 rounded hover:bg-gray-800 inline-block">Contact Us</a>
</div>

<script>
  function toggleEnterpriseFeatures() {
    const button = document.getElementById('view-more-enterprise-btn');
    const hiddenFeatures = document.querySelectorAll('#enterprise-features-list .feature-extra');
    const isHidden = hiddenFeatures[0].classList.contains('hidden');

    hiddenFeatures.forEach(el => {
      if (isHidden) {
        el.classList.remove('hidden');
      } else {
        el.classList.add('hidden');
      }
    });

    button.textContent = isHidden ? 'View Less' : 'View More';
  }
</script>

</section>
<!-- Footer Start -->
<footer>
  <div class="bg-white text-gray-700 mt-12 border-t border-gray-300">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- About -->
      <section aria-labelledby="footer-about-title">
        <h4 id="footer-about-title" class="font-bold text-lg mb-3 text-gray-900">About Journal Joy</h4>
        <p class="text-sm text-gray-600">
          Journal Joy empowers you to take control of your thoughts with a beautiful, easy-to-use platform designed for reflection, planning, and growth.
        </p>
      </section>

      <!-- Quick Links -->
      <nav aria-labelledby="footer-links-title">
        <h4 id="footer-links-title" class="font-bold text-lg mb-3 text-gray-900">Quick Links</h4>
        <ul class="space-y-2 text-sm text-gray-600">
          <li><a href="/dashboard" class="hover:underline hover:text-blue-600">Dashboard</a></li>
          <li><a href="/login" class="hover:underline hover:text-blue-600">Login</a></li>
          <li><a href="#" class="hover:underline hover:text-blue-600">Community</a></li>
          <li><a href="#" class="hover:underline hover:text-blue-600">Support</a></li>
        </ul>
      </nav>

      <!-- Social -->
      <section aria-labelledby="footer-connect-title">
        <h4 id="footer-connect-title" class="font-bold text-lg mb-3 text-gray-900">Connect with Us</h4>
        <div class="flex space-x-4 text-gray-700">
          <a href="#" aria-label="Twitter" class="hover:text-blue-400" rel="noopener noreferrer" target="_blank">
            <i class="ph ph-twitter-logo" aria-hidden="true"></i>
          </a>
          <a href="#" aria-label="Facebook" class="hover:text-blue-600" rel="noopener noreferrer" target="_blank">
            <i class="ph ph-facebook-logo" aria-hidden="true"></i>
          </a>
          <a href="#" aria-label="Instagram" class="hover:text-pink-500" rel="noopener noreferrer" target="_blank">
            <i class="ph ph-instagram-logo" aria-hidden="true"></i>
          </a>
        </div>
      </section>
    </div>
<!-- Bottom Bar -->
<footer>
  <div
    class="border-t border-gray-300 py-5 px-8 flex flex-col md:flex-row items-center justify-between space-y-2 md:space-y-0 select-none text-gray-500 text-sm"
  >
    <div class="text-center md:text-left">
      &copy; <span id="current-year"></span> <span id="journal-joy-main"></span>. All rights reserved. Unauthorized reproduction is prohibited.
    </div>
    <div class="text-center md:text-right">
      Licensed to <span class="font-semibold"><span id="journal-joy-license"></span></span>
    </div>
  </div>
</footer>

<script>
// Define the site name and slogan globally
const siteName = 'Journal Joy';
const siteSlogan = 'Empowering Self-Expression Daily';

// Function to safely update element text content
function setTextById(id, text) {
  const el = document.getElementById(id);
  if (el) el.textContent = text;
}

// Function to set attribute if element exists
function setAttrBySelector(selector, attr, value) {
  const el = document.querySelector(selector);
  if (el) el.setAttribute(attr, value);
}

// Set dynamic content across the page
setTextById('current-year', new Date().getFullYear());
setTextById('journal-joy-main', siteName);
setTextById('journal-joy-license', siteName);
setTextById('name', ` ${siteName}`);

// Optional: Set document title and meta
document.title = `${siteName} | Home Page`;
setAttrBySelector('meta[name="title"]', 'content', `${siteName} - ${siteSlogan}`);
setAttrBySelector('meta[name="description"]', 'content', `Welcome to ${siteName}, where journaling meets inspiration.`);

// Optional: Replace all elements with data-site-name, data-site-slogan
document.querySelectorAll('[data-site-name]').forEach(el => el.textContent = siteName);
document.querySelectorAll('[data-site-slogan]').forEach(el => el.textContent = siteSlogan);

// Optional: Set favicon dynamically (if applicable)
setAttrBySelector('link[rel="icon"]', 'href', '/assets/journaljoy-favicon.png');

// Optional: Set footer tooltip or message
const footerNote = document.getElementById('footer-note');
if (footerNote) {
  footerNote.textContent = `© ${new Date().getFullYear()} ${siteName}. Built with ♥ by Techura Solutions.`;
}

// Optional: Set app version if needed
const appVersion = 'v1.3.0';
setTextById('app-version', appVersion);

</script>

</body>
</html>
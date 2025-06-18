<?php 
$website_title = "Support";
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
      background-color: #f8fafc;
    }
  </style>
</head>
<body class="text-slate-800">

  <main class="min-h-screen flex flex-col items-center justify-start py-16 px-4">
    <div class="w-full max-w-3xl bg-white rounded-3xl shadow-2xl p-10">
      <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-blue-600">Support Center</h1>
        <p class="mt-2 text-gray-600">We’re here to help you with anything related to Journal Joy. Reach out or browse our resources below.</p>
      </div>

      <div class="grid gap-6 md:grid-cols-2">
        <!-- Contact Info -->
        <div class="space-y-6">
          <div class="flex items-start gap-4">
            <i class="ph ph-envelope-simple text-blue-500 text-3xl"></i>
            <div>
              <h3 class="font-semibold text-lg">Email Support</h3>
              <p class="text-gray-600">Reach out to us via email at <a href="mailto:support@journaljoy.com" class="text-blue-600 hover:underline">support@journaljoy.com</a></p>
            </div>
          </div>
          <div class="flex items-start gap-4">
            <i class="ph ph-lightning text-yellow-500 text-3xl"></i>
            <div>
              <h3 class="font-semibold text-lg">System Status</h3>
              <p class="text-gray-600">Check real-time system status and maintenance updates.</p>
              <a href="/status" class="text-blue-600 hover:underline text-sm">View Status Page</a>
            </div>
          </div>
          <div class="flex items-start gap-4">
            <i class="ph ph-book text-green-500 text-3xl"></i>
            <div>
              <h3 class="font-semibold text-lg">Documentation</h3>
              <p class="text-gray-600">Explore user guides, how-tos, and setup instructions.</p>
              <a href="/docs" class="text-blue-600 hover:underline text-sm">View Docs</a>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <form method="POST" action="/submit-support" class="bg-gray-50 rounded-2xl p-6 shadow-inner space-y-5">
          <h2 class="text-xl font-semibold mb-2">Contact Us</h2>

          <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
            <input type="text" name="name" id="name" required class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" id="email" required class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
            <textarea name="message" id="message" rows="4" required class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
          </div>

          <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Send Message</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="bg-white border-t mt-16 py-6 text-center text-sm text-slate-500">
    &copy; <?= date("Y"); ?> <strong><?= htmlspecialchars($company); ?></strong>. All rights reserved.
  </footer>

</body>
</html>

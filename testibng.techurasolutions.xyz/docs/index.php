
<?php
$website_title = "Documentation";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.css" />
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-json.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f9fafb; /* Light background */
      color: #374151; /* Darker text for better contrast */
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      scroll-padding-top: 4.5rem; /* for fixed header offset */
    }

    /* Header */
    header {
      background: #ffffff; /* White background */
      border-bottom: 1px solid #e5e7eb; /* Light border */
      padding: 1rem 2rem;
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 100;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      user-select: none;
    }

    header h1 {
      font-weight: 800;
      font-size: 1.75rem;
      color: #2563eb; /* Blue color */
      cursor: default;
      letter-spacing: -0.02em;
    }

    main {
      margin-top: 4.5rem; /* account for fixed header */
      flex: 1;
      display: flex;
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      gap: 2rem;
      padding: 1.5rem 1rem 3rem 1rem;
      width: 100%;
    }

    /* Sidebar navigation */
    nav#docs-nav {
      flex-basis: 280px;
      background: #ffffff; /* White background */
      border-radius: 0.75rem;
      padding: 1.25rem 1.5rem;
      border: 1px solid #e5e7eb; /* Light border */
      max-height: calc(100vh - 6.5rem);
      overflow-y: auto;
      position: sticky;
      top: 5.75rem; /* below header */
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.1);
      font-weight: 600;
      font-size: 0.95rem;
      color: #475569; /* Slate color */
      user-select: none;
      scrollbar-width: thin;
      scrollbar-color: #a5b4fc transparent;
    }
    nav#docs-nav::-webkit-scrollbar {
      width: 8px;
    }
    nav#docs-nav::-webkit-scrollbar-thumb {
      background-color: #a5b4fc;
      border-radius: 8px;
      border: 2px solid transparent;
      background-clip: content-box;
    }

    nav#docs-nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    nav#docs-nav a {
      color: #475569; /* Slate color */
      text-decoration: none;
      display: block;
      border-radius: 0.5rem;
      padding: 0.4rem 0.75rem;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    nav#docs-nav a:hover,
    nav#docs-nav a:focus {
      background-color: #e0e7ff; /* Light blue */
      color: #3730a3; /* Darker blue */
      outline: none;
      font-weight: 700;
    }

    nav#docs-nav a.active {
      background-color: #6366f1; /* Indigo */
      color: white;
      font-weight: 700;
      box-shadow: 0 0 8px rgba(99, 102, 241, 0.6);
    }

    nav#docs-nav ul ul {
      margin-top: 0.4rem;
      margin-left: 1.1rem;
      border-left: 2px solid #c7d2fe; /* Light indigo */
      padding-left: 0.8rem;
      font-weight: 500;
      font-size: 0.9rem;
      color: #64748b; /* Slate color */
    }

    nav#docs-nav ul ul a {
      padding: 0.3rem 0.5rem;
      border-radius: 0.4rem;
      font-weight: 500;
    }

    nav#docs-nav ul ul a:hover,
    nav#docs-nav ul ul a:focus {
      background-color: #dbeafe; /* Light indigo */
      color: #3730a3; /* Darker blue */
      font-weight: 600;
    }

    /* Article styling */
    article {
      flex: 1;
      background: #ffffff; /* White background */
      padding: 2.25rem 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
      line-height: 1.65;
      color: #334155; /* Slate color */
      overflow-wrap: break-word;
      font-size: 1.1rem;
    }

    article h1,
    article h2 {
      scroll-margin-top: 6rem;
      color: #1e293b; /* Dark slate */
      font-weight: 800;
      letter-spacing: -0.02em;
      user-select: text;
    }

    article h1 {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      border-bottom: 3px solid #6366f1; /* Indigo */
      padding-bottom: 0.3rem;
    }

    article h2 {
      font-size: 1.75rem;
      margin-top: 3rem;
      margin-bottom: 1rem;
      border-left: 5px solid #6366f1; /* Indigo */
      padding-left: 0.8rem;
      color: #4f46e5; /* Indigo */
    }

    article p {
      margin-bottom: 1.2rem;
      color: #475569; /* Slate color */
    }

    article ul {
      list-style: disc inside;
      margin-bottom: 1.3rem;
      color: #475569; /* Slate color */
      padding-left: 1.25rem;
    }

    /* Code blocks */
    pre {
      background: #1e293b; /* Dark slate */
      color: #d1d5db; /* Light gray */
      border-radius: 0.75rem;
      padding: 1.5rem 1.75rem;
      overflow-x: auto;
      position: relative;
      font-size: 0.95rem;
      box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.05);
      margin-bottom: 2rem;
      font-family: 'Fira Code', monospace;
      line-height: 1.4;
    }

    /* Copy button */
    button.copy-btn {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: #4f46e5; /* Indigo */
      color: white;
      border: none;
      border-radius: 0.5rem;
      padding: 0.3rem 0.8rem;
      font-size: 0.85rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 0.35rem;
      transition: background-color 0.2s ease;
      user-select: none;
      box-shadow: 0 2px 8px rgba(79, 70, 229, 0.6);
    }
    button.copy-btn:hover {
      background-color: #4338ca; /* Darker indigo */
    }
    button.copy-btn:focus {
      outline: 2px solid #a5b4fc;
      outline-offset: 2px;
    }

    /* Copy icon (clipboard) */
    button.copy-btn svg {
      width: 16px;
      height: 16px;
      stroke-width: 2;
      stroke: currentColor;
      fill: none;
    }

    /* Breadcrumb */
    nav.breadcrumb {
      margin-bottom: 1rem;
      font-size: 0.9rem;
      color: #64748b; /* Slate color */
      user-select: none;
    }
    nav.breadcrumb ol {
      list-style: none;
      padding: 0;
      display: flex;
      gap: 0.3rem;
      align-items: center;
    }
    nav.breadcrumb li {
      display: inline-flex;
      align-items: center;
    }
    nav.breadcrumb li + li::before {
      content: "/";
      margin: 0 0.3rem;
      color: #cbd5e1; /* Light slate */
    }
    nav.breadcrumb a {
      color: #4f46e5; /* Indigo */
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    nav.breadcrumb a:hover {
      text-decoration: underline;
      color: #4338ca; /* Darker indigo */
    }

    /* Responsive */
    @media (max-width: 1024px) {
      main {
        flex-direction: column;
        max-width: 95%;
        margin: 1rem auto 3rem;
      }
      nav#docs-nav {
        position: relative;
        max-height: none;
        top: auto;
        box-shadow: none;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
      }
    }
  </style>
</head>
<body>

<header>
  <h1><?= htmlspecialchars($company); ?> Docs</h1>
</header>

<main>
  <nav id="docs-nav" aria-label="Documentation Navigation">
    <ul>
      <li>
        <a href="#getting-started" class="active" tabindex="0">Getting Started</a>
        <ul>
          <li><a href="#installation" tabindex="0">Installation</a></li>
          <li><a href="#quickstart" tabindex="0">Quickstart</a></li>
          <li><a href="#creating-account" tabindex="0">Creating An Account</a></li>
          <li><a href="#startingyourjournal" tabindex="0">Starting Your Journal</a></li>
        </ul>
      </li>
      <li>
        <a href="#configuration" tabindex="0">Configuration</a>
        <ul>
          <li><a href="#settings" tabindex="0">Settings</a></li>
          <li><a href="#environment" tabindex="0">Environment Variables</a></li>
          <li><a href="#database-setup" tabindex="0">Database Setup</a></li>
          <li><a href="#logging" tabindex="0">Logging & Monitoring</a></li>
          <li><a href="#caching" tabindex="0">Caching</a></li>
          <li><a href="#email-configuration" tabindex="0">Email Configuration</a></li>
          <li><a href="#third-party-services" tabindex="0">Third-party Services</a></li>
          <li><a href="#security-settings" tabindex="0">Security Settings</a></li>
        </ul>
      </li>
      <li>
        <a href="#api-reference" tabindex="0">API Reference</a>
        <ul>
          <li><a href="#endpoints" tabindex="0">Endpoints</a></li>
          <li><a href="#authentication" tabindex="0">Authentication</a></li>
          <li><a href="vewing" tabindex="0">Viewing Your Journal</a></li>
        </ul>
      </li>
      <li><a href="#faq" tabindex="0">FAQ</a></li>
    </ul>
  </nav>

  <article>
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol>
        <li><a href="/" tabindex="0">Home</a></li>
        <li id="breadcrumb-current" aria-current="page">Getting Started</li>
      </ol>
    </nav>
    <section id="getting-started" tabindex="-1">
      <h1>Getting Started</h1>
      <p>Welcome to the Journal Joy documentation! This section will guide you through the basics so you can get up and running quickly.</p>

      <section id="installation" tabindex="-1">
        <h2>Installation</h2>
        <p>To install Journal Joy, you have several options depending on your environment:</p>
        <ul>
          <li><strong>Using Composer:</strong> Run <code>composer require journaljoy/journaljoy</code> in your project root.</li>
          <li><strong>Manual Download:</strong> Download the latest release from the <a href="https://github.com/journaljoy/journaljoy" target="_blank" rel="noopener">GitHub repository</a> and include it in your project.</li>
          <li><strong>Docker:</strong> Use the official Docker image by pulling <code>journaljoy/journaljoy:latest</code>.</li>
        </ul>
      </section>

      <section id="creating-account" tabindex="-1">
        <h2>Creating An Account</h2>
        <p>To create a Journal Joy account, follow these steps:</p>
        <ul>
          <li>Go to the <a href="/register">Registration Page</a>.</li>
          <li>Fill in your personal information, including username, email, and password.</li>
          <li>Confirm your email address by clicking the verification link sent to your inbox.</li>
          <li>Log in to your new account and start journaling!</li>
        </ul>
      </section>
    </section>
    <pre><button class="copy-btn" aria-label="Copy installation code">
      <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
      Copy
    </button><code class="language-bash">composer require journaljoy/journaljoy</code></pre>
    </section>

    <section id="quickstart" tabindex="-1">
      <h2>Quickstart</h2>
      <p>After installation, initialize Journal Joy with the following code:</p>
      <pre><button class="copy-btn" aria-label="Copy quickstart code">
        <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        Copy
      </button><code class="language-php">&lt;?php
require 'vendor/autoload.php';

use JournalJoy\App;

$app = new App();
$app->run();
?></code></pre>

      <p>This will start the core Journal Joy application with default settings.</p>
    </section>
    </section>
    <section id="configuration" tabindex="-1">
      <h1>Configuration</h1>
      <p>Customize Journal Joy to perfectly fit your needs by managing settings and environment variables.</p>

      <section id="settings" tabindex="-1">
        <h2>Settings</h2>
        <p>The primary configuration happens in <code>config.php</code>. This file lets you define:</p>
        <ul>
          <li>Database connection details</li>
          <li>Cache preferences</li>
          <li>Logging behavior</li>
          <li>API keys for third-party integrations</li>
        </ul>

        <pre><button class="copy-btn" aria-label="Copy config example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h 9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-php">// config.php example
return [
  'database' => [
    'host'     => 'localhost',
    'username' => 'dbuser',
    'password' => 'dbpass',
    'dbname'   => 'journaljoy',
  ],
  'cache'     => true,
  'log_level' => 'debug',
  'api_keys'  => [
    'google_maps' => 'your-google-maps-api-key',
    'mailgun'     => 'your-mailgun-api-key',
  ],
];</code></pre>
      </section>

      <section id="environment" tabindex="-1">
        <h2>Environment Variables</h2>
        <p>Override default config values safely without editing files directly by setting environment variables:</p>
        <ul>
          <li><code>JJ_DB_HOST</code>: Database host</li>
          <li><code>JJ_DB_USER</code>: Database username</li>
          <li><code>JJ_DB_PASS</code>: Database password</li>
          <li><code>JJ_CACHE_ENABLED</code>: Enable or disable cache (<code>true</code>/<code>false</code>)</li>
          <li><code>JJ_LOG_LEVEL</code>: Log verbosity (<code>debug</code>, <code>info</code>, <code>warning</code>, <code>error</code>)</li>
          <li><code>JJ_API_KEYS_GOOGLE_MAPS</code>: Google Maps API key</li>
        </ul>

        <pre><button class="copy-btn" aria-label="Copy environment example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-bash">JJ_DB_HOST=localhost
JJ_DB_USER=dbuser
JJ_DB_PASS=dbpass
JJ_CACHE_ENABLED=true
JJ_LOG_LEVEL=debug
JJ_API_KEYS_GOOGLE_MAPS=your-google-maps-api-key
</code></pre>
      </section>

      <section id="database-setup" tabindex="-1">
        <h2>Database Setup</h2>
        <p>Journal Joy supports both MySQL and PostgreSQL. To prepare your database:</p>
        <ul>
          <li>Configure connection details via <code>config.php</code> or environment variables.</li>
          <li>Run <code>php migrate.php</code> to apply necessary database migrations.</li>
          <li>Regularly back up your database using <code>mysqldump</code> or <code>pg_dump</code> to avoid data loss.</li>
          <li>For security, create dedicated database users with minimal privileges.</li>
        </ul>
      </section>

      <section id="logging" tabindex="-1">
        <h2>Logging &amp; Monitoring</h2>
        <p>Stay informed with flexible logging options. By default, logs are saved in <code>logs/app.log</code>. You can customize:</p>
        <ul>
          <li><code>log_level</code>: Control the detail level of logs (e.g., <code>debug</code>, <code>info</code>, <code>warning</code>, <code>error</code>).</li>
          <li><code>log_file</code>: Specify an alternate log file location.</li>
          <li>Integrate with monitoring platforms like Sentry or New Relic for enhanced error tracking.</li>
        </ul>
      </section>

      <section id="caching" tabindex="-1">
        <h2>Caching</h2>
        <p>Improve performance with caching. Supported options include file-based cache and Redis:</p>
        <ul>
          <li>Toggle caching on/off via <code>cache = true</code> in <code>config.php</code>.</li>
          <li>For Redis, provide connection details in config and ensure the PHP Redis extension is installed.</li>
          <li>Periodically clear cache to prevent stale data issues.</li>
        </ul>
      </section>

      <section id="email-configuration" tabindex="-1">
        <h2>Email Configuration</h2>
        <p>Journal Joy can send emails for notifications, password resets, and more. Configure SMTP settings either in config or environment variables:</p>
        <ul>
          <li>SMTP server address, port, and encryption type (SSL/TLS)</li>
          <li>Authentication credentials for the SMTP server</li>
          <li>Default “From” email address and display name</li>
        </ul>

        <pre><button class="copy-btn" aria-label="Copy SMTP config example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-php">// SMTP config example
return [
  'smtp' => [
    'host'       => 'smtp.mailtrap.io',
    'port'       => 587,
    'encryption' => 'tls',
    'username'   => 'smtp-user',
    'password'   => 'smtp-pass',
    'from_email' => 'no-reply@journaljoy.com',
    'from_name'  => 'Journal Joy',
  ],
];</code></pre>
      </section>

      <section id="third-party-services" tabindex="-1">
        <h2>Third-party Services</h2>
        <p>Extend Journal Joy’s capabilities with integrations:</p>
        <ul>
          <li>OAuth providers like Google, Facebook, and GitHub for seamless authentication</li>
          <li>Analytics tools such as Google Analytics</li>
          <li>Payment gateways including Stripe and PayPal</li>
          <li>Push notification services like Firebase and OneSignal</li>
        </ul>
        <p>Ensure API keys and secrets are stored securely in <code>config.php</code> or environment variables.</p>
      </section>

      <section id="security-settings" tabindex="-1">
        <h2>Security Settings</h2>
        <p>Protect your Journal Joy installation with these best practices:</p>
        <ul>
          <li>Use HTTPS to encrypt all data transfers</li>
          <li>Set strong, unique API keys and rotate them regularly</li>
          <li>Implement rate limiting to defend against brute force attacks</li>
          <li>Configure CORS policies carefully if exposing APIs</li>
          <li>Keep your dependencies and Journal Joy core up to date</li>
          <li>Use secure, HTTP-only cookies to prevent XSS attacks</li>
        </ul>
      </section>
    </section>

    <section id="api-reference" tabindex="-1">
      <h1>API Reference</h1>
      <p>Explore the Journal Joy API endpoints, authentication methods, request/response formats, and best practices.</p>

      <section id="endpoints" tabindex="-1">
        <h2>Endpoints</h2>
        <p>The base URL for all API requests is <code>https://api.journaljoy.com/v1/</code>. Here are some key endpoints:</p>
        <ul>
          <li><code>GET /journals</code>: List all journals (supports pagination)</li>
          <li><code>POST /journals</code>: Create a new journal</li>
          <li><code>GET /journals/{id}</code>: Retrieve a journal by ID</li>
          <li><code>PUT /journals/{id}</code>: Update a journal by ID</li>
          <li><code>DELETE /journals/{id}</code>: Delete a journal by ID</li>
          <li><code>GET /journals/{id}/entries</code>: List all entries for a specific journal</li>
          <li><code>POST /journals/{id}/entries</code>: Add a new entry to a journal</li>
          <li><code>GET /entries/{entry_id}</code>: Retrieve a single journal entry</li>
          <li><code>PUT /entries/{entry_id}</code>: Update a journal entry</li>
          <li><code>DELETE /entries/{entry_id}</code>: Delete a journal entry</li>
        </ul>

        <h3>Example: List Journals with Pagination</h3>
        <p>You can paginate results using <code>page</code> and <code>limit</code> query parameters.</p>

        <pre><button class="copy-btn" aria-label="Copy example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-bash">curl -X GET "https://api.journaljoy.com/v1/journals?page=2&limit=10" \
-H "Authorization: Bearer YOUR_API_TOKEN"
</code></pre>

        <h3>Response Example</h3>
        <pre><code class="language-json">{
  "page": 2,
  "limit": 10,
  "total_pages": 5,
  "total_items": 45,
  "journals": [
    {
      "id": "1234",
      "title": "My Travel Journal",
      "created_at": "2025-06-10T14:12:00Z",
      "updated_at": "2025-06-15T10:00:00Z"
    },
    {
      "id": "1235",
      "title": "Daily Reflections",
      "created_at": "2025-05-01T09:30:00Z",
      "updated_at": "2025-06-16T18:20:00Z"
    }
  ]
}</code></pre>
      </section>

      <section id="authentication" tabindex="-1">
        <h2>Authentication</h2>
        <p>All API requests require a Bearer token passed in the <code>Authorization</code> header:</p>

        <pre><button class="copy-btn" aria-label="Copy authentication example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-bash">Authorization: Bearer YOUR_API_TOKEN
</code></pre>

        <p>Tokens can be obtained via the <code>POST /auth/token</code> endpoint by providing valid user credentials (see <a href="#auth-token">Authentication Guide</a>).</p>
      </section>

      <section id="error-handling" tabindex="-1">
        <h2>Error Handling</h2>
        <p>Errors are returned using standard HTTP status codes with a JSON body describing the issue.</p>

        <pre><code class="language-json">{
  "error": {
    "code": 404,
    "message": "Journal not found"
  }
}</code></pre>

        <ul>
          <li><code>400 Bad Request</code> – Invalid parameters or request format</li>
          <li><code>401 Unauthorized</code> – Missing or invalid authentication token</li>
          <li><code>403 Forbidden</code> – Insufficient permissions</li>
          <li><code>404 Not Found</code> – Resource does not exist</li>
          <li><code>429 Too Many Requests</code> – Rate limit exceeded</li>
          <li><code>500 Internal Server Error</code> – Server encountered an unexpected condition</li>
        </ul>
      </section>

      <section id="rate-limiting" tabindex="-1">
        <h2>Rate Limiting</h2>
        <p>To protect the API, requests are limited to <strong>1000 requests per hour per token</strong>. Exceeding this limit will return a <code>429 Too Many Requests</code> response.</p>
        <p>Rate limit information is provided in the response headers:</p>

        <ul>
          <li><code>X-RateLimit-Limit</code>: The maximum number of requests allowed</li>
          <li><code>X-RateLimit-Remaining</code>: Remaining requests in the current window</li>
          <li><code>X-RateLimit-Reset</code>: Time when the limit resets (Unix timestamp)</li>
        </ul>
      </section>

      <section id="webhooks" tabindex="-1">
        <h2>Webhooks</h2>
        <p>Journal Joy supports webhooks to notify your application of important events in real time. Webhooks use <code>POST</code> requests with JSON payloads.</p>
        <p>Current webhook events:</p>
        <ul>
          <li><code>journal.created</code> – Triggered when a new journal is created</li>
          <li><code>entry.created</code> – Triggered when a new journal entry is added</li>
          <li><code>entry.updated</code> – Triggered when a journal entry is updated</li>
          <li><code>entry.deleted</code> – Triggered when a journal entry is deleted</li>
        </ul>

        <h3>Registering a Webhook</h3>
        <p>Use the endpoint <code>POST /webhooks</code> to register your webhook URL. Example payload:</p>

        <pre><button class="copy-btn" aria-label="Copy webhook registration example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-bash">curl -X POST https://api.journaljoy.com/v1/webhooks \
-H "Authorization: Bearer YOUR_API_TOKEN" \
-H "Content-Type: application/json" \
-d '{
  "url": "https://yourapp.com/webhook-handler",
  "events": ["journal.created", "entry.created"]
}'</code></pre>

        <p>Webhook payload example for a <code>journal.created</code> event:</p>

        <pre><code class="language-json">{
  "event": "journal.created",
  "data": {
    "id": "1234",
    "title": "My Travel Journal",
    "created_at": "2025-06-10T14:12:00Z",
    "user_id": "5678"
  }
}</code></pre>
      </section>

      <section id="pagination" tabindex="-1">
        <h2>Pagination</h2>
        <p>Endpoints returning lists support pagination via query parameters:</p>
        <ul>
          <li><code>page</code> (default: 1) — Page number to retrieve</li>
          <li><code>limit</code> (default: 20, max: 100) — Number of items per page</li>
        </ul>
        <p>Responses include metadata fields <code>page</code>, <code>limit</code>, <code>total_pages</code>, and <code>total_items</code>.</p>
      </section>

      <section id="request-format" tabindex="-1">
        <h2>Request &amp; Response Format</h2>
        <p>All request and response bodies use <code>application/json</code> content type. Set the <code>Content-Type</code> header accordingly when sending data.</p>

        <h3>Example: Create a Journal</h3>
        <pre><button class="copy-btn" aria-label="Copy create journal example">
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0             1 2 2 0 0 1 2 2v1"></path>
          </svg>
          Copy
        </button><code class="language-bash">curl -X POST https://api.journaljoy.com/v1/journals \
-H "Authorization: Bearer YOUR_API_TOKEN" \
-H "Content-Type: application/json" \
-d '{
  "title": "My New Journal",
  "description": "Notes and thoughts"
}'
</code></pre>
      </section>
    </section>

    <section id="faq" tabindex="-1">
      <h1>FAQ</h1>
      <p>Got questions? We’ve got answers.</p>
      <ul>
        <li><strong>Q:</strong> How do I reset my password?<br /><strong>A:</strong> Use the password reset link on the login page.</li>
        <li><strong>Q:</strong> Is there a free trial?<br /><strong>A:</strong> Yes, you can try Journal Joy free for 14 days.</li>
        <li><strong>Q:</strong> Can I self-host?<br /><strong>A:</strong> Currently, Journal Joy is cloud-hosted, but self-hosting is in the roadmap.</li>
      </ul>
    </section>
  </article>
</main>

<script>
  // Handle active nav link and smooth scroll
  const navLinks = document.querySelectorAll('#docs-nav a');
  const sections = Array.from(navLinks).map(link => {
    const id = link.getAttribute('href')?.substring(1);
    return id ? document.getElementById(id) : null;
  }).filter(Boolean);

  function setActiveLink() {
    const scrollPosition = window.scrollY + 100;
    let activeIndex = 0;

    for (let i = 0; i < sections.length; i++) {
      if (sections[i].offsetTop <= scrollPosition) {
        activeIndex = i;
      }
    }

    navLinks.forEach(link => link.classList.remove('active'));
    if (navLinks[activeIndex]) navLinks[activeIndex].classList.add('active');

    // Update breadcrumb text
    const breadcrumbCurrent = document.getElementById('breadcrumb-current');
    if (breadcrumbCurrent && sections[activeIndex]) {
      breadcrumbCurrent.textContent = sections[activeIndex].querySelector('h1, h2')?.textContent || '';
    }
  }

  window.addEventListener('scroll', setActiveLink);
  window.addEventListener('load', setActiveLink);

  // Smooth scroll for nav links
  navLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const targetId = link.getAttribute('href').substring(1);
      const targetEl = document.getElementById(targetId);
      if (targetEl) {
        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        // Update active immediately on click
        navLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
      }
    });
  });

  // Copy button functionality
  document.querySelectorAll('button.copy-btn').forEach(button => {
    button.addEventListener('click', async () => {
      const pre = button.nextElementSibling;
      if (!pre) return;
      const codeBlock = pre.textContent || pre.innerText;
      try {
        await navigator.clipboard.writeText(codeBlock.trim());
        button.textContent = 'Copied!';
        setTimeout(() => {
          button.innerHTML = `<svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy`;
        }, 2000);
      } catch {
        alert('Failed to copy to clipboard.');
      }
    });
  });
</script>

</body>
</html>

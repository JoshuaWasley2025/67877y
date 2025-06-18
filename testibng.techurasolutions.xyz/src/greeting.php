<?php
date_default_timezone_set('Australia/Perth'); // Server timezone

$hrs = (int) date('H');
$minutes = date('i');
$timeString = sprintf("%02d:%s", $hrs, $minutes);

$greet = '';
$colorClass = '';
$emoji = '';

if ($hrs < 12) {
    $greet = 'Good Morning';
    $colorClass = 'text-yellow-600';
    $emoji = '☀️';
} elseif ($hrs >= 12 && $hrs <= 17) {
    $greet = 'Good Afternoon';
    $colorClass = 'text-orange-600';
    $emoji = '🌤️';
} else {
    $greet = 'Good Evening';
    $colorClass = 'text-blue-700';
    $emoji = '🌙';
}

$userName = 'Guest'; // Replace with your dynamic username
?>

<span id="greeting" class="<?= htmlspecialchars($colorClass) ?>">
    <?= htmlspecialchars($emoji) ?> <?= htmlspecialchars($greet) ?>, <?= htmlspecialchars($userName) ?>!
</span>
<br>
<small id="time" class="text-gray-500">
    It's currently <?= htmlspecialchars($timeString) ?> <strong>Perth</strong> time.
</small>

<script>
// Format Date object to Perth time string "HH:mm"
function getPerthTimeString(date) {
    return new Intl.DateTimeFormat('en-AU', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
        timeZone: 'Australia/Perth'
    }).format(date);
}

// Get hours in Perth timezone
function getPerthHours(date) {
    const perthString = new Intl.DateTimeFormat('en-AU', {
        hour: '2-digit',
        hour12: false,
        timeZone: 'Australia/Perth'
    }).format(date);
    return parseInt(perthString, 10);
}

function updateGreeting() {
    const greetingEl = document.getElementById('greeting');
    const timeEl = document.getElementById('time');

    const now = new Date();
    const hrs = getPerthHours(now);
    const timeString = getPerthTimeString(now);

    let greet = '';
    let colorClass = '';
    let emoji = '';

    if (hrs < 12) {
        greet = 'Good Morning';
        colorClass = 'text-yellow-600';
        emoji = '☀️';
    } else if (hrs >= 12 && hrs <= 17) {
        greet = 'Good Afternoon';
        colorClass = 'text-orange-600';
        emoji = '🌤️';
    } else {
        greet = 'Good Evening';
        colorClass = 'text-blue-700';
        emoji = '🌙';
    }

    const userName = 'Guest'; // Change if you have dynamic usernames

    greetingEl.className = colorClass;
    greetingEl.innerHTML = `${emoji} ${greet}, ${userName}!`;
    timeEl.innerHTML = `It's currently ${timeString} <strong>Perth</strong> time.`;
}

// Initial call + update every 60 seconds
updateGreeting();
setInterval(updateGreeting, 60000);
</script>

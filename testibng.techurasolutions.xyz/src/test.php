<?php
// Example user journaling data - replace with your real data source
$totalJournals = 120;      // total journals written
$journalsThisWeek = 5;     // journals written this week
$weeklyGoal = 7;           // user’s weekly journaling goal

// Calculate progress percentage
$progressPercent = min(100, ($journalsThisWeek / $weeklyGoal) * 100);
?>

<?php
// Ambil data dari file
$followers = file('followers.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$followings = file('followings.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Pastikan data dalam bentuk array unik (kalau ada duplikat)
$followers = array_unique($followers);
$followings = array_unique($followings);

// Siapa yang kamu follow tapi mereka gak follow balik
$not_following_back = array_diff($followings, $followers);

// Siapa yang follow kamu tapi kamu gak follow balik
$not_followed_back = array_diff($followers, $followings);

// Mutual
$mutuals = array_intersect($followers, $followings);

// Tampilkan hasil
echo "<h2>🔻 Tidak follow kamu balik:</h2><ul>";
foreach ($not_following_back as $user) {
    echo "<li>$user</li>";
}
echo "</ul>";

echo "<h2>🔺 Kamu tidak follow balik:</h2><ul>";
foreach ($not_followed_back as $user) {
    echo "<li>$user</li>";
}
echo "</ul>";

echo "<h2>✅ Saling follow (Mutual):</h2><ul>";
foreach ($mutuals as $user) {
    echo "<li>$user</li>";
}
echo "</ul>";
?>

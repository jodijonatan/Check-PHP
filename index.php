<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers Check</title>
    <link href="/src/index.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<?php
function ambilUsernames($file) {
    if (!file_exists($file)) {
        echo "<p class='color:red;'>File <b>$file</b> tidak ditemukan.</p>";
        return [];
    }

    $html = file_get_contents($file);
    $usernames = [];

    preg_match_all('/https:\/\/www\.instagram\.com\/([a-zA-Z0-9._]+)"/', $html, $hasil);

    if (isset($hasil[1])) {
        $usernames = array_unique($hasil[1]);
    }

    return $usernames;
}

$followers = ambilUsernames('followers_1.html');
$followings = ambilUsernames('following.html');

$not_following_back = array_diff($followings, $followers);
$not_followed_back = array_diff($followers, $followings);
$mutuals = array_intersect($followers, $followings);

function tampilkanList($judul, $data, $ikon = '') {
    echo "<h2>$ikon $judul (" . count($data) . ")</h2><ul>";
    foreach ($data as $user) {
        echo "<li><a href='https://instagram.com/$user' target='_blank'>$user</a></li>";
    }
    echo "</ul><hr>";
}

// Tampilan di browser
echo '<h1 class="font-bold text-red-600">📊 Analisis Followers cold.joo</h1>';
echo "<p><b>Total Followers:</b> " . count($followers) . "</p>";
echo "<p><b>Total Following:</b> " . count($followings) . "</p><hr>";

tampilkanList('yang ga follback', $not_following_back, '🔻');
tampilkanList('ga kamu follback', $not_followed_back, '🔺');
tampilkanList('saling follow', $mutuals, '✅');
?>

</body>
</html>
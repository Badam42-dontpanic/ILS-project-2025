<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browser Detector</title>
</head>
<body>
    <h1>Browser & OS Detection</h1>
    <p>You are using the following browser to view this site:</p>

    <?php
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Browser Detection
    if (stripos($user_agent, 'Edge') !== false) {
        $browser = 'Microsoft Edge';
    } elseif (stripos($user_agent, 'Firefox') !== false) {
        $browser = 'Mozilla Firefox';
    } elseif (stripos($user_agent, 'Chrome') !== false && stripos($user_agent, 'Chromium') === false) {
        $browser = 'Google Chrome';
    } elseif (stripos($user_agent, 'Chromium') !== false) {
        $browser = 'Chromium';
    } elseif (stripos($user_agent, 'Opera Mini') !== false) {
        $browser = 'Opera Mini';
    } elseif (stripos($user_agent, 'Opera') !== false || stripos($user_agent, 'OPR') !== false) {
        $browser = 'Opera';
    } elseif (stripos($user_agent, 'Safari') !== false && stripos($user_agent, 'Chrome') === false) {
        $browser = 'Safari';
    } else {
        $browser = 'Unknown Browser';
    }

    // OS Detection
    if (stripos($user_agent, 'Windows') !== false) {
        $os = 'Windows';
    } elseif (stripos($user_agent, 'Mac') !== false || stripos($user_agent, 'Macintosh') !== false) {
        $os = 'Mac';
    } elseif (stripos($user_agent, 'Linux') !== false) {
        $os = 'Linux';
    } elseif (stripos($user_agent, 'iOS') !== false || stripos($user_agent, 'iPhone') !== false || stripos($user_agent, 'iPad') !== false) {
        $os = 'iOS';
    } elseif (stripos($user_agent, 'Android') !== false) {
        $os = 'Android';
    } else {
        $os = 'Unknown OS';
    }

    // Output Result
    echo "<p>Your browser is <strong>$browser</strong> and your operating system is <strong>$os</strong>.</p>";
    ?>

</body>
</html>

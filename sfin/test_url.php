<?php
echo "<h1>URL Test</h1>";
echo "<p>PHP is working!</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p>Request URI: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>HTTP Host: " . $_SERVER['HTTP_HOST'] . "</p>";
echo "<p>Server Port: " . $_SERVER['SERVER_PORT'] . "</p>";

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$dirname = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/').'/';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . $dirname;

echo "<p><strong>Calculated Base URL: " . $base_url . "</strong></p>";
echo "<hr>";
echo "<h2>Test Links:</h2>";
echo "<ul>";
echo "<li><a href='" . $base_url . "'>Home</a></li>";
echo "<li><a href='" . $base_url . "auth'>Auth (without login)</a></li>";
echo "<li><a href='" . $base_url . "auth/login'>Auth/Login</a></li>";
echo "<li><a href='" . $base_url . "login'>Login Route</a></li>";
echo "<li><a href='" . $base_url . "dashboard'>Dashboard</a></li>";
echo "</ul>";
?>

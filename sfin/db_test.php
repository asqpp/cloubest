<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Connection Test</h2>";

include('application/config/database.php');
echo "<p>Config loaded</p>";
echo "<p>Host: " . $db['default']['hostname'] . "</p>";
echo "<p>User: " . $db['default']['username'] . "</p>";
echo "<p>Database: " . $db['default']['database'] . "</p>";

$mysqli = new mysqli(
    $db['default']['hostname'],
    $db['default']['username'],
    $db['default']['password'],
    $db['default']['database']
);

if ($mysqli->connect_errno) {
    echo "<p style='color:red'>Connection FAILED: " . $mysqli->connect_error . " (Error #" . $mysqli->connect_errno . ")</p>";
} else {
    echo "<p style='color:green'>Connection SUCCESSFUL!</p>";

    $result = $mysqli->query("SHOW TABLES");
    if ($result) {
        echo "<p>Tables found: " . $result->num_rows . "</p>";
    }

    $result = $mysqli->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p>Users in database: " . $row['count'] . "</p>";
    }

    $mysqli->close();
}
?>

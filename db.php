<?php
// Load environment variable (Render provides DATABASE_URL)
$db_url = getenv("DATABASE_URL");

// Fallback for local testing
if (!$db_url) {
    $db_url = "postgresql://covid_range_user:bwIUYLuFto9IBUg55LJAAzHs0sbD7qSJ@localhost:5432/covid_range";
}

$db_parts = parse_url($db_url);

$host = $db_parts['host'];
$port = isset($db_parts['port']) ? $db_parts['port'] : 5432;
$user = $db_parts['user'];
$pass = $db_parts['pass'];
$dbname = ltrim($db_parts['path'], '/');

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass";

try {
    $pdo = new PDO($dsn);
    // Optional: enable exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>

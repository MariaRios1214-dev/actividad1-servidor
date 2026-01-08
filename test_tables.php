<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/config/db.php";
$pdo = db_connect();

$sql = "SELECT table_name
        FROM information_schema.tables
        WHERE table_schema = 'app'
        ORDER BY table_name";

$rows = $pdo->query($sql)->fetchAll();

echo "<pre>";
print_r($rows);
echo "</pre>";

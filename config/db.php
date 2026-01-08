<?php
function db_connect()
{
    $host = "129.213.139.140";
    $port = "5432";
    $db   = "seriesdb";
    $user = "equipo";
    $pass = "losquieromucho";

    // Conexión PDO a PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // errores como excepciones
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // fetch como array asociativo
        ]);

        // Esto equivale a options: "-c search_path=app"
        $pdo->exec("SET search_path TO app");

        return $pdo;
    } catch (PDOException $e) {
        die("Error conexión PostgreSQL: " . $e->getMessage());
    }
}

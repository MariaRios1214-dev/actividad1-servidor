<?php
require_once __DIR__ . '/../config/db.php';

class PlataformasController
{

    public function index()
    {
        $pdo = db_connect();
        $rows = $pdo->query("SELECT id, nombre FROM plataformas ORDER BY id DESC")->fetchAll();

        // Pasamos $rows
        require __DIR__ . '/../views/plataformas/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/plataformas/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            header("Location: index.php?controller=plataformas&action=create&error=Nombre+obligatorio");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("INSERT INTO plataformas (nombre) VALUES (:nombre)");
        $ok = $stmt->execute([':nombre' => $nombre]);

        header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Creado" : "error=No+se+pudo+guardar"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=plataformas&action=index");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("SELECT id, nombre FROM plataformas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $plataforma = $stmt->fetch();

        if (!$plataforma) {
            header("Location: index.php?controller=plataformas&action=index&error=No+existe");
            exit;
        }

        require __DIR__ . '/../views/plataformas/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');

        if ($id <= 0 || $nombre === '') {
            header("Location: index.php?controller=plataformas&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("UPDATE plataformas SET nombre = :nombre WHERE id = :id");
        $ok = $stmt->execute([':nombre' => $nombre, ':id' => $id]);

        header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Actualizado" : "error=No+se+pudo+actualizar"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=plataformas&action=index");
            exit;
        }

        $pdo = db_connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM plataformas WHERE id = :id");
            $ok = $stmt->execute([':id' => $id]);

            header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Eliminado" : "error=No+se+pudo+eliminar"));
            exit;
        } catch (PDOException $e) {
            // Relaciones al borrar (FK)
            header("Location: index.php?controller=plataformas&action=index&error=No+se+puede+eliminar,+tiene+relaciones");
            exit;
        }
    }
}

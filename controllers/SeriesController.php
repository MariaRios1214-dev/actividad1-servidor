<?php
require_once __DIR__ . '/../config/db.php';

class SeriesController
{

    public function index()
    {
        $pdo = db_connect();

        $sql = "
      SELECT s.id, s.titulo,
             p.nombre AS plataforma,
             d.nombre || ' ' || d.apellidos AS director
      FROM series s
      JOIN plataformas p ON p.id = s.plataforma_id
      JOIN directores d ON d.id = s.director_id
      ORDER BY s.id DESC
    ";

        $rows = $pdo->query($sql)->fetchAll();
        require __DIR__ . '/../views/series/index.php';
    }

    public function create()
    {
        $pdo = db_connect();

        $plataformas = $pdo->query("SELECT id, nombre FROM plataformas ORDER BY nombre")->fetchAll();
        $directores  = $pdo->query("SELECT id, nombre, apellidos FROM directores ORDER BY nombre")->fetchAll();

        require __DIR__ . '/../views/series/create.php';
    }

    public function store()
    {
        $titulo = trim($_POST['titulo'] ?? '');
        $plataforma_id = (int)($_POST['plataforma_id'] ?? 0);
        $director_id   = (int)($_POST['director_id'] ?? 0);

        if ($titulo === '' || $plataforma_id <= 0 || $director_id <= 0) {
            header("Location: index.php?controller=series&action=create&error=Datos+obligatorios");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("INSERT INTO series (titulo, plataforma_id, director_id)
                           VALUES (:titulo, :plataforma_id, :director_id)");
        $ok = $stmt->execute([
            ':titulo' => $titulo,
            ':plataforma_id' => $plataforma_id,
            ':director_id' => $director_id
        ]);

        header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Creado" : "error=No+se+pudo+guardar"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=series&action=index");
            exit;
        }

        $pdo = db_connect();

        $stmt = $pdo->prepare("SELECT id, titulo, plataforma_id, director_id FROM series WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $serie = $stmt->fetch();

        if (!$serie) {
            header("Location: index.php?controller=series&action=index&error=No+existe");
            exit;
        }

        $plataformas = $pdo->query("SELECT id, nombre FROM plataformas ORDER BY nombre")->fetchAll();
        $directores  = $pdo->query("SELECT id, nombre, apellidos FROM directores ORDER BY nombre")->fetchAll();

        require __DIR__ . '/../views/series/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $titulo = trim($_POST['titulo'] ?? '');
        $plataforma_id = (int)($_POST['plataforma_id'] ?? 0);
        $director_id   = (int)($_POST['director_id'] ?? 0);

        if ($id <= 0 || $titulo === '' || $plataforma_id <= 0 || $director_id <= 0) {
            header("Location: index.php?controller=series&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("UPDATE series
                           SET titulo = :titulo, plataforma_id = :plataforma_id, director_id = :director_id
                           WHERE id = :id");
        $ok = $stmt->execute([
            ':titulo' => $titulo,
            ':plataforma_id' => $plataforma_id,
            ':director_id' => $director_id,
            ':id' => $id
        ]);

        header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Actualizado" : "error=No+se+pudo+actualizar"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=series&action=index");
            exit;
        }

        $pdo = db_connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM series WHERE id = :id");
            $ok = $stmt->execute([':id' => $id]);

            header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Eliminado" : "error=No+se+pudo+eliminar"));
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?controller=series&action=index&error=No+se+puede+eliminar,+tiene+relaciones");
            exit;
        }
    }
}

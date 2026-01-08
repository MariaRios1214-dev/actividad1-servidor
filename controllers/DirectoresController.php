<?php
require_once __DIR__ . '/../config/db.php';

class DirectoresController
{

    public function index()
    {
        $pdo = db_connect();
        $rows = $pdo->query("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM directores ORDER BY id DESC")->fetchAll();
        require __DIR__ . '/../views/directores/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/directores/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        if ($nombre === '' || $apellidos === '' || $fecha_nacimiento === '' || $nacionalidad === '') {
            header("Location: index.php?controller=directores&action=create&error=Todos+los+campos+son+obligatorios");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("
      INSERT INTO directores (nombre, apellidos, fecha_nacimiento, nacionalidad)
      VALUES (:nombre, :apellidos, :fecha_nacimiento, :nacionalidad)
    ");

        $ok = $stmt->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':nacionalidad' => $nacionalidad,
        ]);

        header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Creado" : "error=No+se+pudo+guardar"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=directores&action=index");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM directores WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $director = $stmt->fetch();

        if (!$director) {
            header("Location: index.php?controller=directores&action=index&error=No+existe");
            exit;
        }

        require __DIR__ . '/../views/directores/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        if ($id <= 0 || $nombre === '' || $apellidos === '' || $fecha_nacimiento === '' || $nacionalidad === '') {
            header("Location: index.php?controller=directores&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("
      UPDATE directores
      SET nombre = :nombre,
          apellidos = :apellidos,
          fecha_nacimiento = :fecha_nacimiento,
          nacionalidad = :nacionalidad
      WHERE id = :id
    ");

        $ok = $stmt->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':nacionalidad' => $nacionalidad,
            ':id' => $id,
        ]);

        header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Actualizado" : "error=No+se+pudo+actualizar"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=directores&action=index");
            exit;
        }

        $pdo = db_connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM directores WHERE id = :id");
            $ok = $stmt->execute([':id' => $id]);

            header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Eliminado" : "error=No+se+pudo+eliminar"));
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?controller=directores&action=index&error=No+se+puede+eliminar,+tiene+relaciones");
            exit;
        }
    }
}

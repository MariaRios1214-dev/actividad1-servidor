<?php
require_once __DIR__ . '/../config/db.php';

class IdiomasController
{

    public function index()
    {
        $pdo = db_connect();
        $rows = $pdo->query("SELECT id, nombre, iso_code FROM idiomas ORDER BY id DESC")->fetchAll();
        require __DIR__ . '/../views/idiomas/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/idiomas/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $iso_code = strtoupper(trim($_POST['iso_code'] ?? ''));

        // Validaciones (bckend)
        if ($nombre === '' || $iso_code === '') {
            header("Location: index.php?controller=idiomas&action=create&error=Nombre+y+ISO+son+obligatorios");
            exit;
        }

        if (strlen($iso_code) > 10) {
            header("Location: index.php?controller=idiomas&action=create&error=ISO+demasiado+largo");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("INSERT INTO idiomas (nombre, iso_code) VALUES (:nombre, :iso_code)");
        $ok = $stmt->execute([':nombre' => $nombre, ':iso_code' => $iso_code]);

        header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Creado" : "error=No+se+pudo+guardar"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=idiomas&action=index");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("SELECT id, nombre, iso_code FROM idiomas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $idioma = $stmt->fetch();

        if (!$idioma) {
            header("Location: index.php?controller=idiomas&action=index&error=No+existe");
            exit;
        }

        require __DIR__ . '/../views/idiomas/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $iso_code = strtoupper(trim($_POST['iso_code'] ?? ''));

        if ($id <= 0 || $nombre === '' || $iso_code === '') {
            header("Location: index.php?controller=idiomas&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $pdo = db_connect();
        $stmt = $pdo->prepare("UPDATE idiomas SET nombre = :nombre, iso_code = :iso_code WHERE id = :id");
        $ok = $stmt->execute([':nombre' => $nombre, ':iso_code' => $iso_code, ':id' => $id]);

        header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Actualizado" : "error=No+se+pudo+actualizar"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=idiomas&action=index");
            exit;
        }

        $pdo = db_connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM idiomas WHERE id = :id");
            $ok = $stmt->execute([':id' => $id]);

            header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Eliminado" : "error=No+se+pudo+eliminar"));
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?controller=idiomas&action=index&error=No+se+puede+eliminar,+tiene+relaciones");
            exit;
        }
    }
}

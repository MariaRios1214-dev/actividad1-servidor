<?php
require_once __DIR__ . '/../modelos/directores.php';

class DirectoresController
{
    public function index()
    {
        $rows = Directores::obtenerTodos();
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
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        $director = new Directores(null, $nombre, $apellidos, $fecha_nacimiento, $nacionalidad);
        
        if (!$director->esValido()) {
            header("Location: index.php?controller=directores&action=create&error=Todos+los+campos+son+obligatorios");
            exit;
        }

        $ok = $director->guardar();

        header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Director+creado+exitosamente" : "error=Error+al+guardar+el+director"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=directores&action=index");
            exit;
        }

        $director = Directores::obtenerPorId($id);

        if (!$director) {
            header("Location: index.php?controller=directores&action=index&error=Director+no+encontrado");
            exit;
        }

        require_once __DIR__ . '/../views/directores/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        if ($id <= 0) {
            header("Location: index.php?controller=directores&action=edit&id=$id&error=Identificador+de+director+no+valido");
            exit;
        }

        $director = new Directores($id, $nombre, $apellidos, $fecha_nacimiento, $nacionalidad);

        if (!$director->esValido()) {
            header("Location: index.php?controller=directores&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $ok = $director->actualizar();
        header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Director+actualizado+exitosamente" : "error=Error+al+actualizar+el+director"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=directores&action=index");
            exit;
        }

        try {
            $ok = Directores::eliminar($id);
            header("Location: index.php?controller=directores&action=index&" . ($ok ? "success=Director+eliminado+exitosamente" : "error=Error+al+eliminar+el+director"));
            exit;
        } catch (Exception $e) {
            header("Location: index.php?controller=directores&action=index&error=" . urlencode($e->getMessage()));
            exit;
        }
    }
}

<?php
require_once __DIR__ . '/../modelos/actores.php';

class ActoresController
{
    public function index()
    {
        $rows = Actores::obtenerTodos();
        require_once __DIR__ . '/../views/actores/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/actores/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        $actor = new Actores(null, $nombre, $apellidos, $fecha_nacimiento, $nacionalidad);

        if (!$actor->esValido()) {
            header("Location: index.php?controller=actores&action=create&error=Todos+los+campos+son+obligatorios");
            exit;
        }

        $ok = $actor->guardar();
        header("Location: index.php?controller=actores&action=index&" . ($ok ? "success=Actor+creado+exitosamente" : "error=Error+al+guardar+el+actor"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=actores&action=index");
            exit;
        }

        $actor = Actores::obtenerPorId($id);

        if (!$actor) {
            header("Location: index.php?controller=actores&action=index&error=Actor+no+encontrado");
            exit;
        }

        require_once __DIR__ . '/../views/actores/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $nacionalidad = trim($_POST['nacionalidad'] ?? '');

        if ($id <= 0) {
            header("Location: index.php?controller=actores&action=edit&id=$id&error=Identificador+de+actor+no+valido");
            exit;
        }

        $actor = new Actores($id, $nombre, $apellidos, $fecha_nacimiento, $nacionalidad);

        if (!$actor->esValido()) {
            header("Location: index.php?controller=actores&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $ok = $actor->actualizar();
        header("Location: index.php?controller=actores&action=index&" . ($ok ? "success=Actor+actualizado+exitosamente" : "error=Error+al+actualizar+el+actor"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=actores&action=index");
            exit;
        }

        try {
            $ok = Actores::eliminar($id);
            header("Location: index.php?controller=actores&action=index&" . ($ok ? "success=Actor+eliminado+exitosamente" : "error=Error+al+eliminar+el+actor"));
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?controller=actores&action=index&error=No+se+puede+eliminar+este+actor+porque+esta+relacionado+con+otras+series");
            exit;
        }
    }
}

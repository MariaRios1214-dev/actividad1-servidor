<?php
require_once __DIR__ . '/../modelos/plataformas.php';

class PlataformasController
{
    public function index()
    {
        $rows = Plataformas::obtenerTodos();
        require __DIR__ . '/../views/plataformas/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/plataformas/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');

        $plataforma = new Plataformas(null, $nombre);
        
        if (!$plataforma->esValido()) {
            header("Location: index.php?controller=plataformas&action=create&error=El+nombre+es+obligatorio");
            exit;
        }

        $ok = $plataforma->guardar();

        header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Plataforma+creada+exitosamente" : "error=Error+al+guardar+la+plataforma"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=plataformas&action=index");
            exit;
        }

        $plataforma = Plataformas::obtenerPorId($id);

        if (!$plataforma) {
            header("Location: index.php?controller=plataformas&action=index&error=Plataforma+no+encontrada");
            exit;
        }

        require_once __DIR__ . '/../views/plataformas/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');

        if ($id <= 0) {
            header("Location: index.php?controller=plataformas&action=edit&id=$id&error=Identificador+de+plataforma+no+válido");
            exit;
        }

        $plataforma = new Plataformas($id, $nombre);

        if (!$plataforma->esValido()) {
            header("Location: index.php?controller=plataformas&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $ok = $plataforma->actualizar();
        header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Plataforma+actualizada+exitosamente" : "error=Error+al+actualizar+la+plataforma"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=plataformas&action=index");
            exit;
        }

        try {
            $ok = Plataformas::eliminar($id);
            header("Location: index.php?controller=plataformas&action=index&" . ($ok ? "success=Plataforma+eliminada+exitosamente" : "error=Error+al+eliminar+la+plataforma"));
            exit;
        } catch (Exception $e) {
            header("Location: index.php?controller=plataformas&action=index&error=No+se+puede+eliminar+la+plataforma");
            exit;
        }
    }
}

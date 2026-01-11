<?php
require_once __DIR__ . '/../modelos/idiomas.php';

class IdiomasController
{
    public function index()
    {
        $rows = Idiomas::obtenerTodos();
        require_once __DIR__ . '/../views/idiomas/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/idiomas/create.php';
    }

    public function store()
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $iso_code = strtoupper(trim($_POST['iso_code'] ?? ''));

        $idioma = new Idiomas(null, $nombre, $iso_code);
        
        if (!$idioma->esValido()) {
            header("Location: index.php?controller=idiomas&action=create&error=Todos+los+campos+son+obligatorios+y+el+ISO+debe+ser+máximo+10+caracteres");
            exit;
        }

        $ok = $idioma->guardar();

        header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Idioma+creado+exitosamente" : "error=Error+al+guardar+el+idioma"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=idiomas&action=index");
            exit;
        }

        $idioma = Idiomas::obtenerPorId($id);

        if (!$idioma) {
            header("Location: index.php?controller=idiomas&action=index&error=Idioma+no+encontrado");
            exit;
        }

        require_once __DIR__ . '/../views/idiomas/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $iso_code = strtoupper(trim($_POST['iso_code'] ?? ''));

        if ($id <= 0) {
            header("Location: index.php?controller=idiomas&action=edit&id=$id&error=Identificador+de+idioma+no+válido");
            exit;
        }

        $idioma = new Idiomas($id, $nombre, $iso_code);

        if (!$idioma->esValido()) {
            header("Location: index.php?controller=idiomas&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $ok = $idioma->actualizar();
        
        header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Idioma+actualizado+exitosamente" : "error=Error+al+actualizar+el+idioma"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=idiomas&action=index");
            exit;
        }

        try {
            $ok = Idiomas::eliminar($id);
            header("Location: index.php?controller=idiomas&action=index&" . ($ok ? "success=Idioma+eliminado+exitosamente" : "error=Error+al+eliminar+el+idioma"));
            exit;
        } catch (Exception $e) {
            header("Location: index.php?controller=idiomas&action=index&error=No+se+puede+eliminar+el+idioma");
            exit;
        }
    }
}

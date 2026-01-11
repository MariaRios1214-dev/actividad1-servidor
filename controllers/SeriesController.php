<?php
require_once __DIR__ . '/../modelos/series.php';
require_once __DIR__ . '/../modelos/plataformas.php';
require_once __DIR__ . '/../modelos/directores.php';

class SeriesController
{
    public function index()
    {
        $rows = Series::obtenerTodos();
        require __DIR__ . '/../views/series/index.php';
    }

    public function create()
    {
        $plataformas = Plataformas::obtenerTodos();
        $directores  = Directores::obtenerTodos();

        require __DIR__ . '/../views/series/create.php';
    }

    public function store()
    {
        $titulo = trim($_POST['titulo'] ?? '');
        $plataforma_id = (int)($_POST['plataforma_id'] ?? 0);
        $director_id   = (int)($_POST['director_id'] ?? 0);

        $serie = new Series(null, $titulo, $plataforma_id, $director_id);

        if ($titulo === '' || $plataforma_id <= 0 || $director_id <= 0) {
            header("Location: index.php?controller=series&action=create&error=Todos+los+campos+son+obligatorios");
            exit;
        }

        $ok = $serie->guardar();
        header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Serie+creada+exitosamente" : "error=Error+al+guardar+la+serie"));
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=series&action=index");
            exit;
        }

        $serie = Series::obtenerPorId($id);

        if (!$serie) {
            header("Location: index.php?controller=series&action=index&error=Serie+no+encontrada");
            exit;
        }

        $plataformas = Plataformas::obtenerTodos();
        $directores  = Directores::obtenerTodos();

        require __DIR__ . '/../views/series/edit.php';
    }

    public function update()
    {
        $id = (int)($_POST['id'] ?? 0);
        $titulo = trim($_POST['titulo'] ?? '');
        $plataforma_id = (int)($_POST['plataforma_id'] ?? 0);
        $director_id   = (int)($_POST['director_id'] ?? 0);

        if ($id <= 0) {
            header("Location: index.php?controller=series&action=edit&id=$id&error=Identificador+de+serie+no+valido");
            exit;
        }

        $serie = new Series($id, $titulo, $plataforma_id, $director_id);

        if ($titulo === '' || $plataforma_id <= 0 || $director_id <= 0) {
            header("Location: index.php?controller=series&action=edit&id=$id&error=Datos+inválidos");
            exit;
        }

        $ok = $serie->actualizar();
        header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Serie+actualizada+exitosamente" : "error=Error+al+actualizar+la+serie"));
        exit;
    }

    public function delete()
    {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?controller=series&action=index");
            exit;
        }

        try {
            $ok = Series::eliminar($id);
            header("Location: index.php?controller=series&action=index&" . ($ok ? "success=Serie+eliminada+exitosamente" : "error=Error+al+eliminar+la+serie"));
            exit;
        } catch (PDOException $e) {
            header("Location: index.php?controller=series&action=index&error=No+se+puede+eliminar+esta+serie+porque+esta+relacionada+con+otros+datos");
            exit;
        }
    }
}

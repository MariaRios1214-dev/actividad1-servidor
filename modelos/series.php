<?php
require_once __DIR__ . '/../config/db.php';

class Series {
    private $id;
    private $titulo;
    private $plataforma_id;
    private $director_id;
    
    public function __construct($id = null, $titulo = '', $plataforma_id = '', $director_id = '') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->plataforma_id = $plataforma_id;
        $this->director_id = $director_id;
    }
    
    // Getters
    public function getId() {
        return $this->id ?? 'N/A';
    }
    
    public function getTitulo() {
        return $this->titulo ?? 'N/A';
    }
    
    public function getPlataformaId() {
        return $this->plataforma_id ?? 'N/A';
    }
    
    public function getDirectorId() {
        return $this->director_id ?? 'N/A';
    }
    
    // Setters
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
    public function setPlataformaId($plataforma_id) {
        $this->plataforma_id = $plataforma_id;
    }
    
    public function setDirectorId($director_id) {
        $this->director_id = $director_id;
    }
    
    // Métodos de la base de datos
    public static function obtenerTodos() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->query("SELECT id, titulo, plataforma_id, director_id FROM series ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener todas las series");
            return [];
        }
    }
    
    public static function obtenerPorId($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("SELECT id, titulo, plataforma_id, director_id FROM series WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener serie por ID: " . $e->getMessage());
            return null;
        }
    }
    
    public function guardar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                INSERT INTO series (titulo, plataforma_id, director_id)
                VALUES (:titulo, :plataforma_id, :director_id)
            ");
            
            $result = $stmt->execute([
                ':titulo' => $this->titulo,
                ':plataforma_id' => $this->plataforma_id,
                ':director_id' => $this->director_id,
            ]);
            
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error al guardar serie: " . $e->getMessage());
            return false;
        }
    }
    
    public function actualizar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                UPDATE series
                SET titulo = :titulo,
                    plataforma_id = :plataforma_id,
                    director_id = :director_id
                WHERE id = :id
            ");
            
            return $stmt->execute([
                ':titulo' => $this->titulo,
                ':plataforma_id' => $this->plataforma_id,
                ':director_id' => $this->director_id,
                ':id' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar serie: " . $e->getMessage());
            return false;
        }
    }
    
    public static function eliminar($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("DELETE FROM series WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar serie: " . $e->getMessage());
            return false;
        }
    }
}
?>
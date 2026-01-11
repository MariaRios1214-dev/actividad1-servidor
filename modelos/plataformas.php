<?php
require_once __DIR__ . '/../config/db.php';

class Plataformas {
    private $id;
    private $nombre;
    public function __construct($id = null, $nombre = '') {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    
    // Getters
    public function getId() {
        return $this->id ?? 'N/A';
    }
    
    public function getNombre() {
        return $this->nombre ?? 'N/A';
    }
    
    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    // Métodos de la base de datos
    public static function obtenerTodos() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->query("SELECT id, nombre FROM plataformas ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener todas las plataformas");
            return [];
        }
    }
    
    public static function obtenerPorId($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("SELECT id, nombre FROM plataformas WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener plataforma por ID");
            return null;
        }
    }
    
    public function guardar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("INSERT INTO plataformas (nombre) VALUES (:nombre)");
            
            return $stmt->execute([
                ':nombre' => $this->nombre,
            ]);
        } catch (PDOException $e) {
            error_log("Error al guardar plataforma");
            return false;
        }
    }
    
    public function actualizar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("UPDATE plataformas SET nombre = :nombre WHERE id = :id");
            
            return $stmt->execute([':nombre' => $this->nombre, ':id' => $this->id]);
        } catch (PDOException $e) {
            error_log("Error al actualizar plataforma");
            return false;
        }
    }
    
    public static function eliminar($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("DELETE FROM plataformas WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar plataforma");
            throw $e;
        }
    }
    
    public function esValido() {
        return !empty(trim($this->nombre));
    }
}
?>
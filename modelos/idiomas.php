<?php
require_once __DIR__ . '/../config/db.php';

class Idiomas {
    private $id;
    private $nombre;
    private $iso_code;
    
    public function __construct($id = null, $nombre = '', $iso_code = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->iso_code = $iso_code;
    }
    
    // Getters
    public function getId() {
        return $this->id ?? 'N/A';
    }
    
    public function getNombre() {
        return $this->nombre ?? 'N/A';
    }
    
    public function getIsoCode() {
        return $this->iso_code ?? 'N/A';
    }
    
    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setIsoCode($iso_code) {
        $this->iso_code = $iso_code;
    }
    
    public static function obtenerTodos() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->query("SELECT id, nombre, iso_code FROM idiomas ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener todos los idiomas");
            return [];
        }
    }
    
    public static function obtenerPorId($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("SELECT id, nombre, iso_code FROM idiomas WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener idioma por ID");
            return null;
        }
    }
    
    public function guardar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                INSERT INTO idiomas (nombre, iso_code)
                VALUES (:nombre, :iso_code)
            ");
            
            $result = $stmt->execute([
                ':nombre' => $this->nombre,
                ':iso_code' => $this->iso_code,
            ]);
            
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error al guardar idioma");
            return false;
        }
    }
    
    public function actualizar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                UPDATE idiomas
                SET nombre = :nombre,
                    iso_code = :iso_code
                WHERE id = :id
            ");
            
            return $stmt->execute([
                ':nombre' => $this->nombre,
                ':iso_code' => $this->iso_code,
                ':id' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar idioma");
            return false;
        }
    }
    
    public static function eliminar($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("DELETE FROM idiomas WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar idioma");
            throw $e;
        }
    }
    
    public function esValido() {
        return !empty(trim($this->nombre)) && 
               !empty(trim($this->iso_code)) &&
               strlen($this->iso_code) <= 10;
    }
}
?>
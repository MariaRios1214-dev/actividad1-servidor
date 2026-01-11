<?php
require_once __DIR__ . '/../config/db.php';

class Directores {
    private $id;
    private $nombre;
    private $apellidos;
    private $fecha_nacimiento;
    private $nacionalidad;
    
    public function __construct($id = null, $nombre = '', $apellidos = '', $fecha_nacimiento = '', $nacionalidad = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->nacionalidad = $nacionalidad;
    }
    
    // Getters
    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getApellidos() {
        return $this->apellidos;
    }
    
    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }
    
    public function getNacionalidad() {
        return $this->nacionalidad;
    }
    
    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    
    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    
    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
    
    public static function obtenerTodos() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->query("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM directores ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener todos directores");
            return [];
        }
    }
    
    public static function obtenerPorId($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM directores WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($data) {
                return new self($data['id'], $data['nombre'], $data['apellidos'], $data['fecha_nacimiento'], $data['nacionalidad']);
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener director por ID");
            return null;
        }
    }
    
    public function guardar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                INSERT INTO directores (nombre, apellidos, fecha_nacimiento, nacionalidad)
                VALUES (:nombre, :apellidos, :fecha_nacimiento, :nacionalidad)
            ");
            
            $result = $stmt->execute([
                ':nombre' => $this->nombre,
                ':apellidos' => $this->apellidos,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':nacionalidad' => $this->nacionalidad,
            ]);
            
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Error al guardar director");
            return false;
        }
    }
    
    public function actualizar() {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("
                UPDATE directores
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    fecha_nacimiento = :fecha_nacimiento,
                    nacionalidad = :nacionalidad
                WHERE id = :id
            ");
            
            return $stmt->execute([
                ':nombre' => $this->nombre,
                ':apellidos' => $this->apellidos,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':nacionalidad' => $this->nacionalidad,
                ':id' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar director");
            return false;
        }
    }
    
    public static function eliminar($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("DELETE FROM directores WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar director");
            return false;
        }
    }
    
    public function esValido() {
        return !empty(trim($this->nombre)) && 
               !empty(trim($this->apellidos)) && 
               !empty($this->fecha_nacimiento) && 
               !empty(trim($this->nacionalidad));
    }
}
?>        
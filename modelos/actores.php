<?php
require_once __DIR__ . '/../config/db.php';

class Actores{
    private $id;
    private $nombre;
    private $apellidos;
    private $fecha_nacimiento;
    private $nacionalidad;
    
    public function __construct($id = null, $nombre = '', $apellidos = '', $fecha_nacimiento = '', $nacionalidad = ''){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->nacionalidad = $nacionalidad;
    }
    
    // Getters
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getFechaNacimiento(){
        return $this->fecha_nacimiento;
    }
    public function getNacionalidad(){
        return $this->nacionalidad;
    }
    
    // Setters
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    public function setFechaNacimiento($fecha_nacimiento){
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function setNacionalidad($nacionalidad){
        $this->nacionalidad = $nacionalidad;
    }
    
    // Métodos de la base de datos
    public static function obtenerTodos() {
        $pdo = db_connect();
        $rows = $pdo->query("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM actores ORDER BY id DESC")->fetchAll();
        return $rows;
    }
    
    public static function obtenerPorId($id) {
        $pdo = db_connect();
        $stmt = $pdo->prepare("SELECT id, nombre, apellidos, fecha_nacimiento, nacionalidad FROM actores WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    public function guardar() {
        $pdo = db_connect();
        $stmt = $pdo->prepare("INSERT INTO actores (nombre, apellidos, fecha_nacimiento, nacionalidad)
            VALUES (:nombre, :apellidos, :fecha_nacimiento, :nacionalidad)
        ");
        
        return $stmt->execute([
            ':nombre' => $this->nombre,
            ':apellidos' => $this->apellidos,
            ':fecha_nacimiento' => $this->fecha_nacimiento,
            ':nacionalidad' => $this->nacionalidad,
        ]);
    }
    
    public function actualizar() {
        $pdo = db_connect();
        $stmt = $pdo->prepare("UPDATE actores
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
    }
    
    public static function eliminar($id) {
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("DELETE FROM actores WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            throw $e;
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
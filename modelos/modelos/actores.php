<?php
    class actores{
        private $id;
        private $nombre;
        private $apellidos;
        private $fecha_nacimiento;
        private $nacionalidad;
        public function __construct($id, $nombre, $apellidos, $fecha_nacimiento, $nacionalidad){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->fecha_nacimiento = $fecha_nacimiento;
            $this->nacionalidad = $nacionalidad;
        }
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
    }
?>
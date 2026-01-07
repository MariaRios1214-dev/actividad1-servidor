<?php
    class idiomas{
        private $id;
        private $nombre;
        private $iso_code;  
        public function __construct($id, $nombre, $iso_code){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->iso_code = $iso_code;
        }
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getIsoCode(){
            return $this->iso_code;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setIsoCode($iso_code){
            $this->iso_code = $iso_code;
        }
    }
?>
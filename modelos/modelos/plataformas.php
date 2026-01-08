<?php
    class plataformas{
        private $id;
        private $nombre;

        public function __construct($id, $nombre){
            $this->id = $id;
            $this->nombre = $nombre;
        }
        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            if(empty($nombre)){
                echo "No se ha registrado un nombre";
            } else{
                $this->nombre = $nombre;
            }
        }
        
    }
?>
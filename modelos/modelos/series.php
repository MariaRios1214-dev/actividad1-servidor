<?php
 class series{
    private $id;
    private $titulo;
    private $plataforma_id;
    private $director_id;
    public function __construct($id, $titulo, $plataforma_id, $director_id){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->plataforma_id = $plataforma_id;
        $this->director_id = $director_id;
    }  
    public function getId(){
        return $this->id;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getPlataformaId(){
        return $this->plataforma_id;
    }
    public function getDirectorId(){
        return $this->director_id;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function setPlataformaId($plataforma_id){
        $this->plataforma_id = $plataforma_id;
    }
    public function setDirectorId($director_id){
        $this->director_id = $director_id;
    }
 }
?>
<?php
    class series_actores{
        private $series_id;
        private $actores_id;
        public function __construct($series_id, $actores_id){
            $this->series_id = $series_id;
            $this->actores_id = $actores_id;
        }
        public function getSeriesId(){
            return $this->series_id;
        }
        public function getActoresId(){
            return $this->actores_id;
        }
        public function setSeriesId($series_id){
            $this->series_id = $series_id;
        }
        public function setActoresId($actores_id){
            $this->actores_id = $actores_id;
        }
    }
?>
<?php
    class series_idiomas_audio{
        private $series_id;
        private $idiomas_id;
        public function __construct($series_id, $idiomas_id){
            $this->series_id = $series_id;
            $this->idiomas_id = $idiomas_id;
        }
        public function getSeriesId(){
            return $this->series_id;
        }
        public function getIdiomasId(){
            return $this->idiomas_id;
        }
        public function setSeriesId($series_id){
            $this->series_id = $series_id;
        }
        public function setIdiomasId($idiomas_id){
            $this->idiomas_id = $idiomas_id;
        }
    }
?>
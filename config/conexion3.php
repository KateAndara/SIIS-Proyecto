<?php
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
                $conexion = $this->dbh = new PDO("mysql:host=127.0.0.1;dbname=proyecto-siis","SIIS2","12345");
                return $conexion;
            } catch (Exeption $e) {
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
        public function set_names(){
              return $this->dbh->query("SET NAMES 'utf8'");  
        }
    }
?>    
    
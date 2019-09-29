<?php
  class materia{
      private $nombre;
      private $codigo;
      private $cupo;
      private $aula;
     
      function __construct($nombre,$codigo,$cupo,$aula)
      {
        $this->nombre=$nombre;
        $this->codigo=$codigo;
        $this->cupo=$cupo;
        $this->aula=$aula;
      }

      public function __toString()
      {
        return $this->nombre."-".$this->codigo."-".$this->cupo."-".$this->aula.PHP_EOL;
      }
  }
?>
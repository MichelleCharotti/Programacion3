<?php
   class inscripcion
   {
       private $nombre;
       private $apellido;
       private $email;
       private $materia;
       private $codigo;

       function __construct($nombre,$apellido,$email,$materia,$codigo)
       {
          $this->nombre=strtolower($nombre);
          $this->apellido=strtolower($apellido);
          $this->email=strolower($email);
          $this->materia=$materia;
          $this->codigo=$codigo; 
       }

       public function __toString()
       {
           return $this->email."-".$this->nombre."-".$this->apellido."-".$this->materia."-".$this->codigo.PHP_EOL;
       } 
   }
?>
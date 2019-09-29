<?php
 class alumnos{
     private $nombre;
     private $apellido;
     private $email;
     private $foto;

     function __construct($nombre,$apellido,$email,$foto)
     {
         $this->nombre=$nombre;
         $this->apellido=$apellido;
         $this->email=$email;
         $this->foto=$foto;

         $exten=array_reverse(explode(".",$foto["name"])); //divide el nombre de la foto en el punto y
         $this->foto=$this->email."_"."foto.".$exten[0];  //lo revierte para que la extencion quede en el indice cero
      
         move_uploaded_file($foto["tmp_name"],"./imagenAlumno/".$this->foto);//carga la foto
     }

     public function __toString(){
        return $this->email."-".$this->nombre."-".$this->apellido."-".$this->foto.PHP_EOL;
    } 
 }
?>
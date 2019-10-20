<?php
 class usuarios{
     private $legajo;
     private $mail;
     private $nombre;
     private $clave;
     private $foto1;
     private $foto2;
     function __construct($legajo,$mail,$nombre,$clave,$foto1,$foto2)
     {
         $this->legajo=$legajo;
         $this->mail=$mail;
         $this->nombre=$nombre;
         $this->clave=$clave;
         $this->foto1=$foto1;
         $this->foto2=$foto2;
         $exten=array_reverse(explode(".",$foto1["name"])); //divide el nombre de la foto en el punto y
         $this->foto1=$this->legajo."_"."foto1.".$exten[0];  //lo revierte para que la extencion quede en el indice cero
         move_uploaded_file($foto1["tmp_name"],"./imagen/".$this->foto1);//carga la foto

         $exten=array_reverse(explode(".",$foto2["name"])); 
         $this->foto2=$this->legajo."_"."foto2.".$exten[0];  
         move_uploaded_file($foto2["tmp_name"],"./imagen/".$this->foto2);
     }
     public function __toString(){
        return $this->legajo."-".$this->mail."-".$this->nombre."-".$this->clave."-".$this->foto1."-".$this->foto2.PHP_EOL;
    } 
 }
?>
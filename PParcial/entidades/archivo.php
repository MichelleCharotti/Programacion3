<?php
 class archivo{
    
    private $path;
    function __construct($path){
        $this->path=$path;
    }
    public function cargar($entity){
        $archivo=fopen($this->path,"a");
        fwrite($archivo,$entity);
        fclose($archivo);
    }

    public function fileToArray(){
        $array=array();
        $archivo=fopen($this->path,"r");
        while(!feof($archivo))
        {
            $array[]=fgets($archivo);
        }
        fclose($archivo);
        return $array;
    }
    public function arrayToFile($array)
    {
        $archivo=fopen($this->path,"w");
        foreach($array as $registro)
        {
            fwrite($archivo,$registro);
        }
        fclose($archivo);
    }

    public function obtenerArrayRegistro($separador,$identificador,$indice,$cantidad)
    {
        $arrayRetorno=array();
        $array=$this->fileToArray();
        foreach($array as $i => $registro){
            $arrayRegistro=explode($separador,$registro);
            if(Count($arrayRegistro)==$cantidad){
             if(trim($identificador)==trim($arrayRegistro[$indice])){
                $arrayRetorno[]=$registro;
             }
            }
        }
       return $arrayRetorno;
    }

    public function obtenerRegistro($separador,$identificador,$indice,$cantidad)
    {
        $array=$this->fileToArray();
        foreach($array as $i => $registro){
            $arrayRegistro=explode($separador,$registro);
            if(Count($arrayRegistro)==$cantidad){
                if(trim($identificador)==trim($arrayRegistro[$indice])){
                    return $registro;
                }
            }
        }
        return null;
    }
    
    public function modificar($separador,$identificador,$indice,$cantidad,$newEntity)
    {
         $array=$this->fileToArray();
         foreach($array as $i =>$registro)
         {
             $arrayRegistro=explode($separador,$registro);
             if(Count($arrayRegistro)==$cantidad)
             {
                 if(trim($identificador)==trim($arrayRegistro[$indice]))
                 {
                     $array[$i]=$newEntity;
                     break;
                 }
             }
         }
         $this->arrayToFile($array);
    }
    public function BackUp($separador,$identificador,$indice,$cantidad,$detinoOrigen,$indiceBack,$destinoBackUp)
    {
        $arrayRegistro=explode($separador,$this->obtenerRegistro($separador,$identificador,$indice,$cantidad));
        rename("$detinoOrigen/$arrayRegistro[$indiceBack]",$destinoBackUp);
    }
}
?>
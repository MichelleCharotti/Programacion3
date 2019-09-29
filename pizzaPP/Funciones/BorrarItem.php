<?php
include_once './Clases/Pizza.php';
include_once 'agregarFoto.php';
if(isset($_GET['id']))
{
    $miClase = new Pizza();
    $array=array();
    $arrayMiClase = Pizza::leerArchivo ("./Archivos/Pizza.txt");
    $j=0;
    $flag=false;
    if($arrayMiClase!=null)
    {
        foreach($arrayMiClase as $value)
        {
            if($value["id"]==$_GET['id'])
            {
                $flag=true;    
                $foto=$value['foto'];
                var_dump($foto);
                $hoy = date("m.d.y");
                cargar($foto,$hoy,"GET");    
            }
            else
            {
                $array[$j]=$value;
            }
            $j++;
        }
        if($flag==true)
        {
            $miClase->guardarArray($array,"./Archivos/Pizza.txt");
            echo 'Se borro variedad del menu';
        }
        else
        {
            echo 'No se encontro producto';
        }
    }
    else
    {
        echo 'ERROR de lectura de archivo';
    }
}
else
{
    echo 'Faltan datos';
}
?>
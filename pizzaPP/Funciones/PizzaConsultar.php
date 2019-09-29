<?php
include_once "./Clases/Pizza.php";
if(isset($_GET["tipo"]) && isset($_GET['sabor']) )
{
    
    
    $tipo=strtolower($_GET["tipo"]);
    $sabor=strtolower($_GET["sabor"]);
    $arrayMiClase = Pizza::leerArchivo("./Archivos/Pizza.txt");
   	$flag=false;
   	
    $i = 0;
    if($arrayMiClase!=null)
    {
    foreach($arrayMiClase as $value)
    {
        if($value["tipo"] == $tipo && $value['sabor']==$sabor)
        {
            $flag= true;
        
        }
        $i++;
    }
    if($flag==false)
    {
    	echo "No existe la variedad";
    }
    else {
    	 echo "Si hay"; 
    }
    
    }
    else
    {
        echo "Error al leer archivo";
        
    }
    
}
else
{
    echo "Error en los datos";
}
?>
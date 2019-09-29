<?php
include_once "./Clases/Venta.php";
if(isset ($_GET["tipo"]) || isset($_GET["sabor"]) )
{
    $flag=false;
    if(isset($_GET['tipo'])&& isset($_GET['sabor']))
    {
        $miClase = new Venta();
       
        $arrayMiClase = Venta::leerArchivo("./Archivos/Venta.txt");
           $flag=false;
           
        $i = 0;
        if($arrayMiClase!=null)
        {
        foreach($arrayMiClase as $value)
        {
            if($value['tipo'] == $_GET['tipo']&& $value['sabor']== $_GET['sabor'])
            {
                $id= $value["id"]; 
            $tipo= $value["tipo"];
            $sabor=$value['sabor'];
            $precio= $value["precio"];
            $cantidad= $value['cantidad'];
            $usuario= $value["usuario"];
            echo "ID: $id -- Tipo: $tipo -- Sabor: $sabor -- Precio: $precio -- Cantidad: $cantidad -- Usuario: $usuario --".PHP_EOL;
            $flag=true;
            }
            $i++;
        }
        if($flag==false)
        {
            echo "Producto no encontrado";
        }
    }
    else
    {
        echo "Error al leer el archivo";
    }
    }
    else
    {
        if(isset($_GET["tipo"]))
        {
            $var="tipo";
            $get=$_GET["tipo"];
        }
        else
        {
            $var="sabor";
            $get=$_GET["sabor"];
        }
        $miClase = new Venta();
       
        $arrayMiClase = Venta::leerArchivo("./Archivos/Venta.txt");
           $flag=false;
           
        $i = 0;
        if($arrayMiClase!=null)
        {
        foreach($arrayMiClase as $value)
        {
            if($value[$var] == $get)
            {
                $id= $value["id"]; 
            $tipo= $value["tipo"];
            $sabor=$value['sabor'];
            $precio= $value["precio"];
            $cantidad= $value['cantidad'];
            $usuario= $value["usuario"];
            echo "ID: $id -- Tipo: $tipo -- Sabor: $sabor -- Precio: $precio -- Cantidad: $cantidad -- Usuario: $usuario --".PHP_EOL;
            $flag=true;
            }
            $i++;
        }
        if($flag==false)
        {
            echo "Producto no encontrado";
        }
    }
    else
    {
        echo "Error al leer el archivo";
    }
    }
   
}
?>
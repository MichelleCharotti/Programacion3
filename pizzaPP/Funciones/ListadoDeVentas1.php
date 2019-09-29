<?php
include_once "./Clases/Venta.php";
        $miClase = new Venta();
       
        $arrayMiClase = Venta::leerArchivo("./Archivos/Venta.txt");
           
        $i = 0;
        if($arrayMiClase!=null)
        {
        foreach($arrayMiClase as $value)
        {
            
            
                $id= $value["id"]; 
            $tipo= $value["tipo"];
            $sabor=$value['sabor'];
            $precio= $value["precio"];
            $cantidad= $value['cantidad'];
            $usuario= $value["usuario"];
            echo "ID: $id -- Tipo: $tipo -- Sabor: $sabor -- Precio: $precio -- Cantidad: $cantidad -- Usuario: $usuario --".PHP_EOL;
            
            
            $i++;
        }
        
    }
    else
    {
        echo "Error al leer el archivo";
    }
?>
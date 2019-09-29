<?php
include_once "./Clases/Venta.php";
include_once "./Funciones/agregarFoto.php";
if(isset ($_POST["tipo"]) && isset($_POST["sabor"]) && isset($_POST["cantidad"]) && isset($_POST["usuario"]) )
{
    
    $miClase = new Venta();
    $array=array();
    $arrayMiClase = Venta::leerArchivo ("./Archivos/Pizza.txt");
    $arrayMiClase1 = Venta::leerArchivo ("./Archivos/Venta.txt");
   	$flag=false;
   	$flag1=false;
    $i = 0;
    $j = 0;
    $id= 0;
    $precio=0;
    if($arrayMiClase1!=null)
    {
        foreach($arrayMiClase1 as $value)
        {
            if($value["id"])
            {
                    $id=$value["id"]+1;
                    
            }
            $j++;
        }
    }
    else
    {
        $id=1;
    }
    if($arrayMiClase!=null)
    {
    foreach($arrayMiClase as $value)
    {
        if($value["tipo"] == $_POST["tipo"] && $value['sabor']==$_POST['sabor'])
        {
            $flag1=true;
            if($_POST['cantidad']<=$value['cantidad'])
            {
                
                $value['cantidad']=$value['cantidad']-$_POST['cantidad'];
               
                $array[$i]=$value;
                $precio=$value['precio'];
                $flag= true;
                
            }
        }
        else
        {
            $array[$i]=$value;
        }
        $i++;
    }
    
    if($flag1==false)
    {
    	echo    "No se encontro la variedad";
    }
    else
    {
        if($flag==false)
    {
        echo "No hay cantidad suficiente para satisfacer el pedido";
    }
    else
    {
        $miClase->guardarArray($array,"./Archivos/Pizza.txt");
        $precio=$_POST['cantidad']*$precio;
        $miClase-> miConstructor($id,$_POST['tipo'],$precio,$_POST['cantidad'],$_POST['usuario'],$_POST['sabor']);
        $miClase -> guardarArchivo("./Archivos/Venta.txt");
        echo "Se cargo venta";
    }
    }
    
    }
    
    else
    {
        
        echo "Error de lectura";
    }
    
}
else
{
    echo "falta completar datos";
}
?>
<?php
require_once "./Clases/Pizza.php";
   require_once "agregarFoto.php"; 
if(isset($_POST['tipo'])&& isset($_POST['precio'])&& isset($_POST['cantidad'])&& isset($_POST['sabor'])&& isset($_FILES['foto']))
{
    
    $miClase = new Pizza();
    $arrayMiClase = Pizza::leerArchivo ("./Archivos/Pizza.txt");
    $flag=false;
    $id=0;
    $i = 0;
    if($arrayMiClase!=null)
    {
        foreach($arrayMiClase as $value)
        {
            if($value["id"])
            {
                    $id=$value["id"]+1;
                    
            }
            $i++;
        }
        $j = 0;
        foreach($arrayMiClase as $value)
        {
            if($value["tipo"] == $_POST['tipo'] && $value['sabor']==$_POST['sabor'])
            {
                    $flag=true;
                    break;
            }
        $j++;
        }
     if($flag==true)
     {
         echo("Tipo y sabor ya se encuentra en la lista");
         
     }
        
        
    }
    else
    {
        $id=1;
    }
    if($flag==false)
    {
        $foto=cargar($_FILES['foto'],$id,'POST');
        $miClase -> miConstructor($id, $_POST["tipo"], $_POST["precio"], $foto, $_POST ["cantidad"],$_POST['sabor']);
        $miClase -> guardarArchivo("./Archivos/Pizza.txt");
        echo "Se cargo producto";
    }
    
}
else{
    echo "falta completar datos";
}
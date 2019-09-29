<?php
function cargar($file, $id,$metodo )
{
	$dic = "./Fotos/";
    $dicBackup = "./FotosBackUp/";
    if($metodo=='POST')
    {
        $nameImagen = $file["name"];  
    }
    else
    {
        $nameImagen = $file; 
    }
    
   
	if($id!=null)
	{
		$datoImagen=$id;
	}
   
    
	$explode = explode(".", $nameImagen);
	$tamaño = count($explode);
	$dic .= $datoImagen;
	$dic .= ".";
	$dic .= $explode[$tamaño - 1];
	
    $dicBackup.=$datoImagen;
    $dicBackup.=".";
	$dicBackup .=$explode[$tamaño - 1];
	if($metodo=='POST')
    {    
        move_uploaded_file($_FILES["foto"]["tmp_name"], $dic);	
        	
	}
	else
	{
        copy($file,$dicBackup);
        
		
	}
    
    return $dic;
}
?>
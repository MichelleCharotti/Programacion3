<?php
require_once("./entidades/usuarios.php");
require_once("./entidades/archivo.php");
//require_once("./entidades/materia.php");
//require_once("./entidades/inscripcion.php");
$archivoUsuario=new archivo("./archivos/usuarios.txt");
//$archivoMaterias=new archivo("./archivos/materias.txt");
//$archivoInscripciones=new archivo("./archivos/inscripcion.txt");
error_reporting(E_ALL ^ E_NOTICE);
session_start();


if(isset($_POST["caso"])&& !empty($_POST["caso"]))
{
    $caso=$_POST["caso"];
    switch($caso)
    {
        case "cargarUsuario":
            $legajo=$_POST["legajo"];
            $mail=$_POST["mail"];
            $nombre=$_POST["nombre"];
            $clave=$_POST["clave"];
            $foto1=$_FILES["foto1"];
            $foto2=$_FILES["foto2"];
            echo "<br/> Cargar usuario";
            $usuario=new usuarios($legajo,$mail,$nombre,$clave,$foto1,$foto2);
            $archivoUsuario->cargar($usuario);
            var_dump(json_encode($usuario));
            break;
        case "modificarUsuario":
            echo "<br/> Modificar";
            $legajo=$_POST["legajo"];
            $mail=$_POST["mail"];
            $nombre=$_POST["nombre"];
            $clave=$_POST["clave"];
            $foto1=$_FILES["foto1"];
            $foto2=$_FILES["foto2"];
            if($archivoUsuario->obtenerRegistro("-",$legajo,0,6)!=null)
            {
                $fecha=date("dmy");
                $nombreBackUp="./backup/$legajo.borrado.$fecha.png";
                $destinoOrigen="./imagen";
                $archivoUsuario->BackUp("-",$legajo,0,6,$destinoOrigen,0,$nombreBackUp);
                $usuarioModificado=new usuarios($legajo,$mail,$nombre,$clave,$foto1,$foto2);
                $archivoUsuario->modificar("-",$legajo,0,6,$usuarioModificado);
            }else
                {
                    echo "No existe el usuario";
                }
            break;
        default:
            echo "caso invalido";
            break;
    }
}
else if(isset($_GET["caso"])&& !empty($_GET["caso"]))
    {  
        $caso = $_GET["caso"];
        switch($caso)
        {
            case "login":
                 echo "<br/> Login";
                 $legajo=$_GET["legajo"];
                 $clave=$_GET["clave"];
                 $arrayCoincidencias=$archivoUsuario->obtenerArrayRegistro("-",strtolower($legajo),0,6);
                 if(Count($arrayCoincidencias)==0){
                     echo "<br/>No existe usuario con legajo".$legajo;
                 }
                 else{
                    $arrayCoincide=$archivoUsuario->obtenerArrayRegistro("-",strtolower($clave),3,6);
                    if(Count($arrayCoincide)==0){
                        echo "<br/>Clave incorrecta";
                    }else{
                        echo "<br/>Coincidencias:";
                        foreach($arrayCoincidencias as $registro){
                            echo "<br/>".$registro;
                        }
                    }
                 }
                break;
                case "verUsuarios":
                echo "<br/> Usuarios";
                $arrayUsuario = $archivoUsuario->fileToArray();
                $tabla = "<table border='1'>
                                    <caption>Usuarios</caption>
                                    <thead>
                                        <tr>
                                            <th>Legajo</th>
                                            <th>Mail</th>
                                            <th>Nombre</th>
                                            <th>Foto1</th>
                                            <th>Foto2</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                foreach($arrayUsuario as $usuarios1){
                    $arrayInscripcion = explode("-",$usuarios1);
                    $tabla = $tabla."<tr>
                        <td>$arrayInscripcion[0]</td>
                        <td>$arrayInscripcion[1]</td>
                        <td>$arrayInscripcion[2]</td>
                        <td><img style='width: 100px; height: 100px;' src='./imagen/$arrayInscripcion[4]'></td>
                        <td><img style='width: 100px; height: 100px;' src='./imagen/$arrayInscripcion[5]'></td>
                    </tr>";            
                }
                $tabla = $tabla."</tbody>
                            </table>";
                echo $tabla;
                
            break;
            
            default:
                echo "caso invalido";
                break;
        }
    }
    else{
        echo "Debe establecer un caso.";
    }

    $archivoUsuario->cargar($_SESSION["caso"]);

?>
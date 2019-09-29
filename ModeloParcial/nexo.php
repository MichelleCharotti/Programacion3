<?php
require_once("./entidades/alumnos.php");
require_once("./entidades/archivo.php");
require_once("./entidades/materia.php");
require_once("./entidades/inscripcion.php");

$archivoAlumno=new archivo("./archivos/alumnos.txt");
$archivoMaterias=new archivo("./archivos/materias.txt");
$archivoInscripciones=new archivo("./archivos/inscripcion.txt");

if(isset($_POST["caso"])&& !empty($_POST["caso"]))
{
    $caso=$_POST["caso"];

    switch($caso)
    {
        case "cargarAlumno":
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $email=$_POST["email"];
            $foto=$_FILES["foto"];

            echo "<br/> Cargar alumno";

            $alumno=new alumnos($nombre,$apellido,$email,$foto);
            $archivoAlumno->cargar($alumno);
            break;
        case "cargarMateria":
            $nombre=$_POST["nombre"];
            $codigo=$_POST["codigo"];
            $cupo=$_POST["cupo"];
            $aula=$_POST["aula"];
            echo "<br/> Cargar materia";
            $materia=new materia($nombre,$codigo,$cupo,$aula);
            $archivoMaterias->cargar($materia);
             break;
        case "modificarAlumno":
            echo "<br/> Modificar alumno";
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $email=$_POST["email"];
            $foto=$_FILES["foto"];
            if($archivoAlumno->obtenerRegistro("-",$email,0,4)!=null)
            {
               $fecha=date("dmy");
               $nombreBackUp="./backUpFoto/$email.borrado.$fecha.png";
               $destinoOrigen="./imagenAlumno";
               $archivoAlumno->BackUp("-",$email,0,4,$destinoOrigen,3,$nombreBackUp);
               $alumnoModificado=new alumnos($nombre,$apellido,$email,$foto);
               $archivoAlumno->modificar("-",$email,0,4,$alumnoModificado);
            }else
            {
                echo "No existe el alumno";
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
            case "consultarAlumno":
                 echo "<br/> Consultar alumno";

                 $apellido=$_GET["apellido"];
                 $arrayCoincidencias=$archivoAlumno->obtenerArrayRegistro("-",strtolower($apellido),2,4);

                 if(Count($arrayCoincidencias)==0){
                     echo "<br/>No existe alumno con apellido".$apellido;
                 }
                 else{
                     echo "<br/>Coincidencias:";
                     foreach($arrayCoincidencias as $registro){
                         echo "<br/>".$registro;
                     }
                 }
                break;
            case "inscribirAlumno":
                echo "<br/>Inscribir alumno";
                $nombreAlumno=$_GET["nombre"];
                $apellidoAlumno=$_GET["apellido"];
                $email=$_GET["email"];
                $materia=$_GET["materia"];
                $codigoMateria=$_GET["codigo"];
                $registroMateria=$archivoMaterias->obtenerRegistro("-",$codigoMateria,1,4);

                if(count($registroMateria)>0)
                {
                    $registroMateria=explode("-",$registroMateria);
                    $cupo=$registroMateria[2];
                    if($cupo>0)
                    {
                        $inscripcion=new inscripcion($nombreAlumno,$apellido,$email,$materia,$codigoMateria);
                        $archivoInscripciones->cargar($inscripcion);
                        $materiaModificada=new materia($materia,$codigoMateria,$cupo-1,$registroMateria[3]);
                        $archivoMaterias->modificar("-",$codigoMateria,1,4,$materiaModificada);
                    }else{
                        echo "No hay cupo";
                    }
                }else{
                    echo "No existe la materia";
                }
                break;
            case "inscripciones":
                echo "<br/>Inscripciones";
                $archivoInscripciones=array();
                if(isset($_GET["materia"])&& !empty($_GET["materia"]))
                {
                   $arrayInscripciones=$archivoInscripciones->obtenerArrayRegistros("-",$_GET["apellido"],2,5);
                }
                elseif(isset($_GET["apellido"])&& !empty($_GET["apellido"])){
                    $arrayInscripciones=$archivoInscripciones->obtenerArrayRegistros("-",$_GET["apellido"],2,5);
                }
                else{
                    $arrayInscripciones=$archivoInscripciones->fileToArray();
                }

                $tabla="<<table border='1'>
                <caption>Inscriptos</caption>
                <thead>
                    <tr>
                        <th>Nombre Alumno</th>
                        <th>Apellido Alumno</th>
                        <th>Materia</th>
                    </tr>
                </thead>
                <tbody>";
                foreach($arrayInscripciones as $inscripcion)
                {
                    $arrayInscripcion = explode("-",$inscripcion);   
                    $tabla = $tabla."<tr>
                                    <td>$arrayInscripcion[1]</td>
                                    <td>$arrayInscripcion[2]</td>
                                    <td>$arrayInscripcion[3]</td>
                                </tr>";
                }
                $tabla=$tabla."</tbody>
                               </table>";
                echo $table;
                break;
            case "alumnos":
                echo "<br/> Alumnos";
                $arrayAlumnos = $archivoAlumno->fileToArray();
                $tabla = "<table border='1'>
                                    <caption>Inscriptos</caption>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                foreach($arrayAlumno as $inscripcion){
                    $arrayInscripcion = explode("-",$inscripcion);
                    $tabla = $tabla."<tr>
                        <td>$arrayInscripcion[1]</td>
                        <td>$arrayInscripcion[2]</td>
                        <td>$arrayInscripcion[0]</td>
                        <td><img style='width: 100px; height: 100px;' src='./AlumnosImagen/$arrayInscripcion[3]'></td>
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
?>
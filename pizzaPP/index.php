<?php

$tipo = $_SERVER['REQUEST_METHOD'];
echo $tipo;
switch ($tipo) {
    case 'GET':
 //var_dump($_GET);
    switch ($_GET["caso"]) {
        case "PizzaConsultar":
           require_once "./Funciones/PizzaConsultar.php";
            break;
        
        case 'ListadoDeVentas':
        if(isset($_GET["tipo"])||isset($_GET["sabor"]))
        {
            require_once "./Funciones/listadoDeVentas.php";
        }
        else
        {
            require_once "./Funciones/listadoDeVentas1.php";
        }           
            break;
    }
        break;
    
    case 'POST':
        switch ($_POST["caso"])
        {
            case 'PizzaCarga':
                require_once "./Funciones/PizzaCarga.php";
                break;
            
            case 'AltaVenta':
                require_once "./Funciones/AltaVenta.php";
                break;
        }
        break;
    case 'DELETE':
        require_once "./Funciones/BorrarItem.php";
        break;
}

?>
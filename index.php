<?php
require_once 'config/connection.php';

// Con esta sección hacemos el Controlador del Frontend
if(!isset($_REQUEST['c']))
{
    require_once "controller.php";
    $controller = new controller();
    $controller->Index();    
}
else
{
    // buscamos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    // Instanciamos el controlador
    require_once "controller.php";
    $controller = new controller();
    
    // Función para llamar las acciones a ejecutar
    call_user_func( array( $controller, $accion ) );
}
?>
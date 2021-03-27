<?php

require_once "controladores/inicio.controlador.php";
require_once "controladores/empleados.controlador.php";

require_once "modelos/empleados.modelo.php";

$inicio = new ControladorInicio();

$inicio->inicio();

?>
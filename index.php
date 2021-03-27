<?php

require_once "controladores/inicio.controlador.php";
require_once "controladores/empleados.controlador.php";
require_once "controladores/areas.controlador.php";
require_once "controladores/roles.controlador.php";

require_once "modelos/empleados.modelo.php";
require_once "modelos/areas.modelo.php";
require_once "modelos/roles.modelo.php";

$inicio = new ControladorInicio();

$inicio->inicio();

?>
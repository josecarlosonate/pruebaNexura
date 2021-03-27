<?php

class ControladorEmpleados{

    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarEmpleados(){

		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla);

		return $respuesta;

	}
}

?>
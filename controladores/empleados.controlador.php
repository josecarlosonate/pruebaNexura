<?php

class ControladorEmpleados{

    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarEmpleados(){

		$tabla = "empleados";
		$tablaArea = "areas";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla,$tablaArea);

		return $respuesta;

	}
}

?>
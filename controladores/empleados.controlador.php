<?php

class ControladorEmpleados{

	// public $datos;

    /*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarEmpleados(){

		$tabla = "empleados";
		$tablaArea = "areas";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla,$tablaArea);

		return $respuesta;

	}

	/*=============================================
	GUARDAR USUARIO
	=============================================*/

	static public function ctrGuardarEmpleados($datos){

		$tabla = "empleados";
		$tablaEmpleadoRol = "empleado_rol";

		$respuesta = ModeloEmpleados::mdlGuardarEmpleados($tabla,$tablaEmpleadoRol,$datos);
        
		return $respuesta;
		

	}
}

?>
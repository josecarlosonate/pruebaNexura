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

if(isset($_POST["accion"])){
	if($_POST["accion"] == 'nuevo'){
		$empleado = new ControladorEmpleados();
		$empleadodata = json_decode($_POST['empleado'],true);
        
		
		// validar con expresion regular nombre y email
		if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $empleadodata['nombre'])
		&& preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $empleadodata['email'] )
		){
			$empleado-> ctrGuardarEmpleados($empleadodata);
		}
        
	}
}

?>
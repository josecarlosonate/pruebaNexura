<?php

class ControladorEmpleados{

	// public $datos;

    /*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function ctrMostrarEmpleados(){

		$tabla = "empleados";
		$tablaArea = "areas";

		$respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla,$tablaArea);

		return $respuesta;

	}

	/*=============================================
	GUARDAR EMPLEADO
	=============================================*/

	static public function ctrGuardarEmpleados($datos){

		$tabla = "empleados";
		$tablaEmpleadoRol = "empleado_rol";

		$respuesta = ModeloEmpleados::mdlGuardarEmpleados($tabla,$tablaEmpleadoRol,$datos);
        
		return $respuesta;
		

	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/

	static public function ctrEliminarEmpleados($id){
		$tabla = "empleados";

		$respuesta = ModeloEmpleados::mdlEliminarEmpleados($tabla,$id);
        
		return $respuesta;
		
	}

	/*=============================================
	TRAER DATOS DE EMPLEADO A EDITAR
	=============================================*/

	static public function ctrTraerEmpleado($id){
		$tabla = "empleados";
		$tablaArea = "areas";
		$tablaEmpleadoRol = "empleado_rol";
		$tablaRol = "roles";

		$respuesta = ModeloEmpleados::mdlTraerEmpleado($tabla,$id,$tablaArea,$tablaEmpleadoRol,$tablaRol);
        
		return $respuesta;
		
	}
}

?>
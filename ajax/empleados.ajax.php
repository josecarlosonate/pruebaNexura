<?php

require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleados{

	/*=============================================
	AGREGAR EMPLEADO
	=============================================*/

	public $datosEmpleado;	

	public function ajaxGuardarEmpleados(){

		$datos = $this->datosEmpleado;

		$respuesta = ControladorEmpleados::ctrGuardarEmpleados($datos);

		echo json_encode($respuesta);

	}


}


/*=============================================
AGREGAR EMPLEADO
=============================================*/

if(isset($_POST["accion"])){
	if($_POST["accion"] == 'nuevo'){
		$empleado = new AjaxEmpleados();
		$empleadodata = json_decode($_POST['empleado'],true);
        
		
		// validar con expresion regular nombre y email
		if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $empleadodata['nombre'])
		&& preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $empleadodata['email'] )
		){
			$empleado -> datosEmpleado = $empleadodata;

			$empleado->ajaxGuardarEmpleados();
		}
        
	}
}

?>

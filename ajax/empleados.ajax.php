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

		echo ($respuesta);

	}

	/*=============================================
	CONSULTAR EMPLEADO
	=============================================*/
    
	public function ajaxConsultarEmpleados(){

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados();

		echo json_encode($respuesta);
	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/
    
	public function ajaxEliminarEmpleado($id){

		$respuesta = ControladorEmpleados::ctrEliminarEmpleados($id);

		echo ($respuesta);
	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/
    
	public function ajaxTraerEmpleado($id){

		$respuesta = ControladorEmpleados::ctrTraerEmpleado($id);

		echo json_encode($respuesta);
	}

}



if(isset($_POST["accion"])){
	// nuevo empleado
	if($_POST["accion"] == 'nuevo'){
		$empleado = new AjaxEmpleados();
		$empleadodata = json_decode($_POST['empleado'],true);
        
		
		// validar con expresion regular nombre y email
		if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $empleadodata['nombre'])
		&& preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $empleadodata['email'] )
		){
			$empleado -> datosEmpleado = $empleadodata;

			$empleado->ajaxGuardarEmpleados();
		}else{
			echo "error";
		}
        
	}

	// consultar empleados 
	if($_POST["accion"] == 'consultar'){
		$empleado = new AjaxEmpleados();
		$empleado->ajaxConsultarEmpleados();
	}

	// eliminar empleados 
	if($_POST["accion"] == 'eliminar'){
		$empleado = new AjaxEmpleados();
		$empleado->ajaxEliminarEmpleado($_POST["id"]);
	}

	// traer o editar empleados 
	if($_POST["accion"] == 'traer' || $_POST["accion"] == 'editar'){
		$empleado = new AjaxEmpleados();
		$empleado->ajaxTraerEmpleado($_POST["id"]);
	}
}

?>

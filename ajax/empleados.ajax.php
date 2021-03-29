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
    
	public function ajaxEliminarEmpleados($id){

		$respuesta = ControladorEmpleados::ctrEliminarEmpleados($id);

		echo ($respuesta);
	}

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/
    
	public function ajaxEditarEmpleados($id){

		$respuesta = ControladorEmpleados::ctrEditarEmpleados($id);

		echo ($respuesta);
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
		$empleado->ajaxEliminarEmpleados($_POST["id"]);
	}

	// editar empleados 
	if($_POST["accion"] == 'editar'){
		$empleado = new AjaxEmpleados();
		$empleado->ajaxEditarEmpleados($_POST["id"]);
	}
}

?>

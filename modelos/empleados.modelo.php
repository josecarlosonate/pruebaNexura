<?php

require_once "conexion.php";

class ModeloEmpleados{

    /*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla,$tablaArea){
		$stmt = (new Conexion)->conectar()->prepare("SELECT e.nombre, e.email, e.sexo, e.boletin, a.nombre as area FROM $tabla e INNER JOIN $tablaArea a ON e.area_id = a.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;

	}
}

?>
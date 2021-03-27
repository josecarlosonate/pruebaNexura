<?php

require_once "conexion.php";

class ModeloEmpleados{

    /*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla){

		$stmt = (new Conexion)->conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;

	}
}
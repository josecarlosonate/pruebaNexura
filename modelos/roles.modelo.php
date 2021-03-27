<?php

require_once "conexion.php";

class ModeloRoles{
    /*=============================================
	MOSTRAR ROLES
	=============================================*/

    static public function mdlMostrarRoles($tabla){

        $stmt = (new Conexion)->conectar()->prepare("SELECT * FROM $tabla ");

        $stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
    }
}

?>
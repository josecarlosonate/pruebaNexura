<?php

require_once "conexion.php";

class ModeloAreas{
    /*=============================================
	MOSTRAR AREAS
	=============================================*/

    static public function mdlMostrarAreas($tabla){

        $stmt = (new Conexion)->conectar()->prepare("SELECT * FROM $tabla ");

        $stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
    }
}

?>
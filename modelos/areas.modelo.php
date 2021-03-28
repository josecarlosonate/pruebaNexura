<?php

require_once "conexion.php";

class ModeloAreas{
    /*=============================================
	MOSTRAR AREAS
	=============================================*/

    static public function mdlMostrarAreas($tabla){
        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla ");

        $stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
    }
}

?>
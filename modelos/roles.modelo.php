<?php

require_once "conexion.php";

class ModeloRoles{
    /*=============================================
	MOSTRAR ROLES
	=============================================*/

    static public function mdlMostrarRoles($tabla){
        $db = new Conexion();
        $stmt = $db->pdo->prepare("SELECT * FROM $tabla ");

        $stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;
    }
}

?>
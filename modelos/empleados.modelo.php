<?php

require_once "conexion.php";

class ModeloEmpleados {

    /*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla,$tablaArea){
		$stmt = (new Conexion)->conectar()->prepare("SELECT e.nombre, e.email, e.sexo, e.boletin, a.nombre as area FROM $tabla e INNER JOIN $tablaArea a ON e.area_id = a.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt = null;

	}

	/*=============================================
	GUARDAR EMPLEADOS
	=============================================*/

	static public function mdlGuardarEmpleados($tabla,$tablaEmpleadoRol,$datos){
		$datos["area_id"] = intval($datos["area_id"]);
        // return  ($datos);
		// die();

		$stmt = (new Conexion)->conectar()->prepare("INSERT INTO $tabla(nombre,email,sexo,area_id,boletin,descripcion) VALUES (:nombre, :email,:sexo, :area_id, :boletin, :descripcion)");
        
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":area_id", $datos["area_id"], PDO::PARAM_INT);
		$stmt->bindParam(":boletin", $datos["boletin"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $nReg = $stmt->execute();
		if($nReg > 0){
            
			//ULTIMO REGISTRO EN LA TABLA 
			// $db = new conexion();
			// $sql = $db->conectar()->prepare('SELECT @@IDENTITY AS IdEmpleado');    
			// $sql->execute();
			// $result = $sql->fetch();              
			// $id = $result['IdEmpleado']; 	
            // return  $id;
		}
		
		$stmt = null;
		

	}
}

?>
<?php

require_once "conexion.php";

class ModeloEmpleados
{

	/*=============================================
	MOSTRAR EMPLEADOS
	=============================================*/

	static public function mdlMostrarEmpleados($tabla, $tablaArea)
	{
		$db = new Conexion();
		$stmt = $db->pdo->prepare("SELECT e.id, e.nombre, e.email, e.sexo, e.boletin, a.nombre as area FROM $tabla e INNER JOIN $tablaArea a ON e.area_id = a.id ORDER BY e.id");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/*=============================================
	GUARDAR EMPLEADOS
	=============================================*/

	static public function mdlGuardarEmpleados($tabla, $tablaEmpleadoRol, $datos)
	{
		$datos["area_id"] = intval($datos["area_id"]);

		$db = new Conexion();
		$stmt = $db->pdo->prepare("INSERT INTO $tabla(nombre,email,sexo,area_id,boletin,descripcion) VALUES (:nombre, :email,:sexo, :area_id, :boletin, :descripcion)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":area_id", $datos["area_id"], PDO::PARAM_INT);
		$stmt->bindParam(":boletin", $datos["boletin"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$nReg = $stmt->execute();

		if ($nReg > 0) {

			//ULTIMO REGISTRO EN LA TABLA 
			$id_empleado = $db->pdo->lastInsertId();
			$roles = $datos["roles"];

			foreach ($roles as $rol) {
				$dbrol = new Conexion();
				$stmtrol = $dbrol->pdo->prepare("INSERT INTO $tablaEmpleadoRol(empleado_id,rol_id) VALUES (:empleado_id, :rol_id)");

				$stmtrol->bindParam(":empleado_id", $id_empleado, PDO::PARAM_INT);
				$stmtrol->bindParam(":rol_id", $rol, PDO::PARAM_INT);

				$stmtrol->execute();
			}
			return "ok";
			// return sizeof($roles);
		}

		$stmt = null;
	}

	/*=============================================
	ELIMINAR EMPLEADOS
	=============================================*/

	static public function mdlEliminarEmpleados($tabla, $id)
	{
		$db = new Conexion();
		$stmt = $db->pdo->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		$nReg = $stmt->execute();

		if ($nReg > 0) {

			return 'ok';
		} else {

			return 'error';
		}
	}

	/*=============================================
	TRAER DATOS DE EMPLEADO A EDITAR
	=============================================*/

	static public function mdlTraerEmpleado($tabla, $id, $tablaArea, $tablaEmpleadoRol, $tablaRol)
	{
		$db = new Conexion();

		$stmt = $db->pdo->prepare("SELECT e.id, e.nombre, e.email, e.sexo, e.boletin, e.descripcion, a.nombre as area ,a.id as id_area FROM $tabla e INNER JOIN $tablaArea a ON e.area_id = a.id  WHERE e.id = :id ");

		$stmt2 = $db->pdo->prepare("SELECT r.nombre, r.id as id_roles FROM $tablaRol r INNER JOIN $tablaEmpleadoRol er ON r.id = er.rol_id WHERE er.empleado_id = :id");


		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt2->bindParam(":id", $id, PDO::PARAM_INT);

		$stmt->execute();
		$data = $stmt->fetch();
		$stmt2->execute();
		$roles = $stmt2->fetchAll();

		$res = array(
			'data' => $data,
			'roles' => $roles
		);

		return $res;

		$stmt = null;
		$stmt2 = null;
	}

	/*=============================================
	    EDITAR
	=============================================*/

	static public function mdlEditarEmpleado($tabla, $id, $tablaEmpleadoRol, $datos)
	{
		$db = new Conexion();
		$stmt = $db->pdo->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, sexo = :sexo, area_id =:area_id, boletin = :boletin, descripcion = :descripcion  WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":area_id", $datos["area_id"], PDO::PARAM_INT);
		$stmt->bindParam(":boletin", $datos["boletin"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);


		$nReg = $stmt->execute();

		if ($nReg > 0) {

			//ULTIMO REGISTRO EN LA TABLA 
			$id_empleado = $id;

			$dbdeletRol = new Conexion();
			$stmtdeletRol = $dbdeletRol->pdo->prepare("DELETE FROM $tablaEmpleadoRol WHERE empleado_id = :empleado_id");

			$stmtdeletRol->bindParam(":empleado_id", $id, PDO::PARAM_INT);

			$nDeletReg = $stmtdeletRol->execute();

			if ($nDeletReg > 0) {

				$roles = $datos["roles"];
                
				foreach ($roles as $rol) {
					$dbrol = new Conexion();
					$stmtrol = $dbrol->pdo->prepare("INSERT INTO $tablaEmpleadoRol(empleado_id,rol_id) VALUES (:empleado_id, :rol_id)");

					$stmtrol->bindParam(":empleado_id", $id_empleado, PDO::PARAM_INT);
					$stmtrol->bindParam(":rol_id", $rol, PDO::PARAM_INT);

					$stmtrol->execute();
				}
				return "actualizado";
			}

		}else{
			return "error";
		}
	}
}

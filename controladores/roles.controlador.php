<?php

class ControladorRoles{
    
    /*=============================================
	MOSTRAR ROLES
	=============================================*/

    static public function ctrMostrarRoles(){

		$tabla = "roles";

		$respuesta = ModeloRoles::mdlMostrarRoles($tabla);

		return $respuesta;

	}
}

?>
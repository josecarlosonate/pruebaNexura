<?php

class ControladorAreas{

    /*=============================================
	MOSTRAR AREAS
	=============================================*/

	static public function ctrMostrarAreas(){

		$tabla = "areas";

		$respuesta = ModeloAreas::mdlMostrarAreas($tabla);

		return $respuesta;

	}
}

?>
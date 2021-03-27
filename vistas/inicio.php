<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="title" content="pruena nexura">

    <meta name="description" content="realizacion de prueba php nexura">

    <meta name="keyword" content="prueba nexura, php">

    <title>Nexura</title>

    <!--=====================================
	HOJA DE CSS 
	======================================-->

    <link rel="stylesheet" href="vistas/css/plugins/bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/css/estilo.css">


</head>

<body>
    <div class="container">
        <div class="centrar">
            <img src="vistas/img/bienvenido.svg" class="img-fluid" alt="bienvenida">
            <div>
                <h2 class="text-center">Bienvenido</h2>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Listado de empleados
                <a class="btn btn-outline-success float-right" data-toggle="modal" data-target="#Modal">Crear Nuevo Empleado</a>
            </div>
            <div class="card-body">
                <?php
                $empleados = ControladorEmpleados::ctrMostrarEmpleados();
                if (!$empleados) {
                ?>
                    <p class="text-info">Aun no hay empleados registrados</p>
                <?php
                } else {
                ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fa fa-user"></i> &nbsp;Nombre</th>
                                    <th scope="col"><i class="fa fa-at"></i> &nbsp;Email</th>
                                    <th scope="col"><i class="fa fa-venus-mars"></i> &nbsp;Sexo</th>
                                    <th scope="col"><i class="fa fa-briefcase"></i> &nbsp;Area</th>
                                    <th scope="col"><i class="fa fa-envelope"></i> &nbsp;Boletin</th>
                                    <th scope="col">Modificar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($empleados as $key => $value) {
                                ?>
                                    <tr>
                                        <th class="text-primary"><?php echo $value["nombre"] ?></th>
                                        <th class="text-primary"><?php echo $value["email"] ?></th>
                                        <th class="text-primary"><?php echo $value["sexo"] ?></th>
                                        <th class="text-primary"><?php echo $value["area"] ?></th>
                                        <th class="text-primary"><?php echo $resultado = ($value["boletin"] == 0)  ? "NO" : "SI" ?>
                                        </th>
                                        <th class="text-primary iconoEditar"><i class="fa fa-edit"></i></th>
                                        <th class="text-primary iconoBorrar"><i class="fa fa-trash"></i></th>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear nuevo empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">los campos marcados con * son obligatorios</h6>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre completo <b class="text-danger"> *</b></span>
                        </div>
                        <input type="text" id="usuario" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email <b class="text-danger"> *</b></span>
                        </div>
                        <input type="email" id="email" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sexo <b class="text-danger"> *</b></span>
                        </div>&nbsp;&nbsp;
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="M" name="optradio">Masculino
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" value="F" name="optradio">Femenino
                            </label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Area <b class="text-danger"> *</b></span>
                        </div>
                        <select class="form-control" id="sltArea">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <div class="input-group-prepend">
                        <span class="input-group-text">Descripcion <b class="text-danger"> *</b></span>
                    </div>
                    <textarea class="form-control" rows="4" id="comment"></textarea>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="">
                                <input type="radio" id="boletin" aria-label="Radio">
                            </div>
                        </div>&nbsp;
                        <label for="">Desea recibir boletin informativo?</label>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Roles <b class="text-danger"> *</b></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!--=====================================
	PLUGINS DE JAVASCRIPT
	======================================-->

    <script src="https://kit.fontawesome.com/2c9eef3e53.js" crossorigin="anonymous"></script>

    <script src="vistas/js/plugins/jquery-3.5.1.slim.min.js"></script>

    <script src="vistas/js/plugins/bootstrap4.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="vistas/js/plugins/jquery.validate.min.js"></script>

    <!--=====================================
    MI JAVASCRIPT
    ======================================-->

    <script src="vistas/js/main.js"></script>

</body>

</html>
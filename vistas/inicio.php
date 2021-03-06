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
                <h2 class="text-center">Bienvenid@</h2>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Listado de empleados
                <a class="btn btn-outline-success float-right" data-toggle="modal" data-target="#Modal"><i class="fa fa-user-plus"></i> Nuevo Empleado</a>
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
                                    <th scope="col">Ver</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="listadoEmpleados">
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
                    <button type="button" id="btnCerrarM" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="formularioRegistro">
                    <div class="modal-body">
                        <h6 class="text-danger">los campos marcados con * son obligatorios</h6>
                        <!-- nombre  -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nombre completo <b class="text-danger"> *</b></span>
                            </div>
                            <input type="text" id="nombre" name="nombre" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- email  -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email <b class="text-danger"> *</b></span>
                            </div>
                            <input type="email" id="email" class="form-control" name="email" aria-describedby="basic-addon1">
                        </div>
                        <!-- sexo  -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sexo <b class="text-danger"> *</b></span>
                            </div>&nbsp;&nbsp;
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" id="sexo" class="form-check-input optradio" value="M" name="sexo">Masculino
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" id="sexo" class="form-check-input optradio" value="F" name="sexo">Femenino
                                </label>
                            </div>
                        </div>
                        <!-- listado de areas  -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Area <b class="text-danger"> *</b></span>
                            </div>
                            <select class="form-control" id="sltArea" name="sltArea">
                                <?php
                                $areas = ControladorAreas::ctrMostrarAreas();
                                if (!$areas) {
                                ?>
                                    <option class="text-info" value="0">no existen areas</option>
                                    <?php
                                } else {
                                    foreach ($areas as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- descripcion  -->
                        <div class="input-group-prepend">
                            <span class="input-group-text">Descripcion <b class="text-danger"> *</b></span>
                        </div>
                        <textarea class="form-control" rows="4" id="descripcion" name="descripcion"></textarea>
                        <!-- boletin  -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="">
                                    <input type="checkbox" id="boletin" aria-label="Radio">
                                </div>
                            </div>&nbsp;
                            <label for="">Desea recibir boletin informativo?</label>
                        </div>
                        <!-- roles  -->
                        <div class="input-group-prepend">
                            <span class="input-group-text">Roles <b class="text-danger"> *</b></span>
                        </div>
                        <ul class="list-group">
                            <?php
                            $roles = ControladorRoles::ctrMostrarRoles();
                            if (!$roles) {
                            ?>
                                <p class="text-info">no hay roles registrados</p>
                                <?php
                            } else {
                                foreach ($roles as $key => $value) {
                                ?>
                                    <li class="list-group-item list-group-item-success">
                                        &nbsp;<input type="checkbox" id="roles" name='roles[]' class="form-check-input roles" value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ver Empleado-->
    <div class="modal fade" id="ModalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Detalles Del Empleado</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- nombre  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nombre:</span>
                                </div>
                                <input type="text" id="verNombre" name="verNombre" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- nombre  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Email:</span>
                                </div>
                                <input type="email" id="verEmail" name="verEmail" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <!-- sexo  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sexo:</span>
                                </div>
                                <input type="text" id="verSexo" name="verSexo" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- area  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Area:</span>
                                </div>
                                <input type="text" id="verArea" name="verArea" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- boletin  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Recibe Boletin:</span>
                                </div>
                                <input type="text" id="verBoletin" name="verBoletin" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- descripcion  -->
                            <div class="input-group mb-3">
                                <label for="" class="input-group-text">Descripcion: </label>
                                <textarea name="verDescripcion" id="verDescripcion" rows="3" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- roles  -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Roles asignados:</span>
                                </div>
                                <input type="text" id="verRoles" name="verRoles" class="form-control" aria-label="Username" aria-describedby="basic-addon1" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Editar Empleado-->
    <div class="modal fade" id="ModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  text-warning" id="exampleModalLabel">Editar Empleado</h5>
                </div>
                <div class="modal-body">
                    <form action="" id="formularioEditar">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- nombre  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nombre:</span>
                                    </div>
                                    <input type="text" id="editNombre" name="editNombre" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <!-- email  -->
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email:</span>
                                    </div>
                                    <input type="email" id="editEmail" name="editEmail" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- sexo  -->
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sexo:</span>
                                    </div>
                                    <div class="form-control">
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="editSexoM" name="editSexo" class="form-check-input optradio" value="M" name="sexo">Masculino
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" id="editSexoF" name="editSexo" class="form-check-input optradio" value="F" name="sexo">Femenino
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- area  -->
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Area:</span>
                                    </div>
                                    <select class="form-control" id="sltEditArea" name="sltEditArea">
                                        <?php
                                        foreach ($areas as $key => $value) {
                                        ?>
                                            <option name="<?php echo $value["nombre"] ?>" value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- boletin  -->
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Recibe Boletin:</span>
                                    </div>
                                    <div class="form-control">
                                        <div class="custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="editBoletin">
                                            <label class="custom-control-label" for="editBoletin" id="lblBoletin"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- descripcion  -->
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <label for="" class="input-group-text">Descripcion: </label>
                                    <textarea name="editDescripcion" id="editDescripcion" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- roles  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Roles:</span>
                                    </div>
                                        <ul class="list-group">
                                            <?php
                                            foreach ($roles as $key => $value) {
                                            ?>
                                                <li class="list-group-item">
                                                    &nbsp;<input type="checkbox" id="editRoles<?php echo $value["id"] ?>" name='editRoles[]' class="form-check-input editRoles" value="<?php echo $value["id"] ?>"><?php echo $value["nombre"] ?>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="idEmpleado" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnEditar" class="btn btn-primary">Guardar Cambios</button>
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
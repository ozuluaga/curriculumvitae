<?php include("../../templates/header.php") ?>
<br>
<div class="card">

    <div class="card-header">
        Usuarios
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agreagar usuario</a>

    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del usuarios </th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">01</td>
                        <td>olvedo</td>
                        <td>***</td>
                        <td>olvedo@olvedo.com</td>
                        <td>
                            <input name="btneditar" id="btneditar" class="btn btn-info" type="button" value="Editar">
                            <input name="btneliminar" id="btneliminar" class="btn btn-danger" type="button" value="Eliminar">
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>







<?php include("../../templates/footer.php") ?>
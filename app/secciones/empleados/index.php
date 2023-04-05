<?php include("../../templates/header.php") ?>
<br />

<div class="card">
    <div class="card-header">
        Empleados

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agreagar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Cv</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">Oscar</td>
                        <td>image.jpg</td>
                        <td>cv.pdf</td>
                        <td>Programador Sr</td>
                        <td>21/05/2020</td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                            |<a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                            |<a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>


                    </tr>


                </tbody>
            </table>
        </div>



    </div>
</div>



<?php include("../../templates/footer.php") ?>
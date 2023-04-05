<?php
include("../../db.php");

// ELiminar Datos
if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";
    $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    header("Location:index.php");
}


// Buscar Datos
$sentencia = $conexion->prepare("SELECT *,(SELECT nombre_puesto  FROM tbl_puestos WHERE tbl_puestos.id =tbl_empleados.id_puesto limit 1 )as puesto FROM tbl_empleados"); //subconsulta de las tablas
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//print_r($lista_tbl_puestos);


?>

<?php include("../../templates/header.php") ?>
<br />

<div class="card">
    <div class="card-header">
        Empleados

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Cv</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_tbl_empleados as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id'] ?></td>
                            <td scope="row">
                                <?php echo $registro['primer_nombre'] ?>
                                <?php echo $registro['segundo_nombre'] ?>
                                <?php echo $registro['primer_apellido'] ?>
                                <?php echo $registro['segundo_apellido'] ?>
                            </td>
                            <td><?php echo $registro['foto'] ?></td>
                            <td><?php echo $registro['cv'] ?></td>
                            <td><?php echo $registro['puesto'] ?></td>
                            <td><?php echo $registro['fecha_ingreso'] ?></td>
                            <td>
                                <a class="btn btn-primary" href="editar.php?txtId= <?php echo $registro['id']; ?>" role="button">Carta</a>
                                <a class="btn btn-info" href="editar.php?txtId= <?php echo $registro['id']; ?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="index.php?txtId= <?php echo $registro['id']; ?>" role="button">Eliminar</a>
                            </td>


                        </tr>
                    <?php  } ?>


                </tbody>
            </table>
        </div>



    </div>
</div>



<?php include("../../templates/footer.php") ?>
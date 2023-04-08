<?php
include("../../db.php");

// ELiminar Datos
if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";

    //Buscar el archivo relacionado
    $sentencia = $conexion->prepare("SELECT foto, cv FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    print_r($registro_recuperado);

    //Borrado de archivo foto
    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
        if (file_exists("fotos_empleados/" . $registro_recuperado["foto"])) { // preguntamos si el archivo existe en la carpeta
            unlink("fotos_empleados/" . $registro_recuperado["foto"]); //borramos el archivo en la carpeta

        }
    }
    //Borrado archivo pdf
    if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
        if (file_exists("cv_empleados/" . $registro_recuperado["cv"])) { // preguntamos si el archivo existe en la carpeta
            unlink("cv_empleados/" . $registro_recuperado["cv"]); //borramos el archivo en la carpeta

        }
    }




    $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $mensaje = "Registro Eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
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
            <table class="table" id="tabla_id">
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
                            <td>
                                <img width="50" src="<?php echo "fotos_empleados/" . $registro['foto']; ?>" class="img-fluid rounded" alt="">



                            </td>
                            <td>
                                <a href="<?php echo $registro['cv'] ?>">
                                    <?php echo $registro['cv'] ?>
                                </a>
                            </td>
                            <td><?php echo $registro['puesto'] ?></td>
                            <td><?php echo $registro['fecha_ingreso'] ?></td>
                            <td>
                                <a class="btn btn-primary" href="carta_recomendacion.php?txtId= <?php echo $registro['id']; ?>" role="button" target="_blank">Carta</a>
                                <a class="btn btn-info" href="editar.php?txtId= <?php echo $registro['id']; ?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="javascript:borrar( <?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                            </td>


                        </tr>
                    <?php  } ?>


                </tbody>
            </table>

        </div>



    </div>
</div>



<?php include("../../templates/footer.php") ?>
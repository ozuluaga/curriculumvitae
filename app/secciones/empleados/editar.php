<?php
include("../../db.php");

// Recepcion de datos al formulario
if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre = $registro['primer_nombre'];
    $segundonombre = $registro['segundo_nombre'];
    $primerapellido = $registro['primer_apellido'];
    $segundoapellido = $registro['segundo_apellido'];

    $cv = $registro['cv'];
    $foto = $registro['foto'];

    $idpuesto = $registro['id_puesto'];
    $fechadeingreso = $registro['fecha_ingreso'];
}


//Busca los puestos.
$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Editar Datos
if ($_POST) {
    // Recolectamos los datos del metodo POST
    $txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
    $primernombre = (isset($_POST["primernombre"]) ? $_POST["primernombre"] : "");
    $segundonombre = (isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "");
    $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
    $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
    $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");



    // Preparar la Actualizacion de los datos
    $sentencia = $conexion->prepare("UPDATE tbl_empleados SET primer_nombre =:primernombre , segundo_nombre =:segundonombre, primer_apellido =:primerapellido, segundo_apellido =:segundoapellido, id_puesto = :idpuesto, fecha_ingreso = :fechadeingreso WHERE id=:id
    ");

    // Asignando los valores que vienen del metodo POST
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");

    $fecha_ = new DateTime(); //Obtener el tiempo
    $nombreArchivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : ""; //Armar el nombre del archivo para que nose sobrescriba con otro
    $tmp_foto = $_FILES["foto"]['tmp_name']; // utilizar un archivo temporal

    //Borrado de archivo foto
    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto,  "fotos_empleados/" . $nombreArchivo_foto); // para mover el archivo a un nuevo destino
        // print_r(move_uploaded_file($tmp_foto, "fotos_empleados/" . $nombreArchivo_foto));
        $sentencia = $conexion->prepare("SELECT foto FROM tbl_empleados WHERE id=:id");
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

        $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id
    ");
        $sentencia->bindParam(":foto", $nombreArchivo_foto);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
    }

    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

    $nombreArchivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : ""; //Armar el nombre del archivo para que nose sobrescriba con otro
    $tmp_cv = $_FILES["cv"]['tmp_name']; // utilizar un archivo temporal

    //Borrado archivo pdf
    if ($tmp_cv != '') {
        move_uploaded_file($tmp_cv,  "cv_empleados/" . $nombreArchivo_cv); // para mover el archivo a un nuevo destino

        $sentencia = $conexion->prepare("SELECT cv FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);


        //Borrado de archivo foto
        if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
            if (file_exists("cv_empleados/" . $registro_recuperado["cv"])) { // preguntamos si el archivo existe en la carpeta
                unlink("cv_empleados/" . $registro_recuperado["cv"]); //borramos el archivo en la carpeta

            }
        }




        $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id
        ");
        $sentencia->bindParam(":cv", $nombreArchivo_cv);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
    }
    //print_r($nombreArchivo_foto);
    //print_r($sentencia);
    $mensaje = "Registro Actualizado";
    header("Location:index.php?mensaje=" . $mensaje);
}


?>



<?php include("../../templates/header.php") ?>
<br />
<div class="card">
    <div class="card-header">
        Editar Empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="txtId" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="txtId" id="txtId" readonly aria-describedby="helpId" placeholder="ID" value="<?php echo $txtId; ?>">

                </div>
                <div class="mb-3">
                    <label for="primernombre" class="form-label">Primer Nombre</label>
                    <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre" value="<?php echo $primernombre; ?>">
                </div>
                <div class="mb-3">
                    <label for="segundonombre" class="form-label">Segundo Nombre</label>
                    <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre" value="<?php echo $segundonombre; ?>">
                </div>
                <div class="mb-3">
                    <label for="primerapellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido" value="<?php echo $primerapellido; ?>">
                </div>
                <div class="mb-3">
                    <label for="segundoapellido" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido" value="<?php echo $segundoapellido; ?>">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <br>
                    <img width="100" src="<?php echo "fotos_empleados/" . $foto; ?>" class=" rounded" alt="" />
                    <br><br>

                    <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">

                </div>
                <div class="mb-3">
                    <label for="cv" class="form-label">CV(PDF):</label>
                    <br>
                    <a target="_blank" href="<?php echo "cv_empleados/" . $cv; ?>"><?php echo $cv; ?></a>
                    <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
                </div>
                <div class="mb-3">
                    <label for="idpuesto" class="form-label">Puesto:</label>

                    <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
                        <?php foreach ($lista_tbl_puestos as $registro) { ?>
                            <option <?php echo ($idpuesto == $registro['id']) ? "selected" : "" ?> value="<?php echo $registro['id'] ?>"><?php echo $registro['nombre_puesto'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fechadeingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de Ingreso" value="<?php echo $fechadeingreso; ?>">
                </div>

                <button type="submit" class="btn btn-success">Actualizar Registro</button>
                <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>

    </div>

</div>




<?php include("../../templates/footer.php") ?>
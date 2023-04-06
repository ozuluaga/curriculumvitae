<?php
include("../../db.php");
// Insertar Datos
if ($_POST) {
    //print_r($_POST);
    //print_r(($_FILES));

    // Recolectamos los datos del metodo POST
    $primernombre = (isset($_POST["primernombre"]) ? $_POST["primernombre"] : "");
    $segundonombre = (isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "");
    $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
    $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");

    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

    $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
    $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");
    // Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("INSERT INTO tbl_empleados (id, primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,foto,cv,id_puesto, fecha_ingreso ) VALUES (null, :primernombre,:segundonombre,:primerapellido,:segundoapellido,:foto,:cv,:idpuesto,:fechadeingreso)");


    // Asignando los valores que vienen del metodo POST
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre);
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);

    //Subir Foto
    $fecha_ = new DateTime(); //Obtener el tiempo
    $nombreArchivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : ""; //Armar el nombre del archivo para que nose sobrescriba con otro
    $tmp_foto = $_FILES["foto"]['tmp_name']; // utilizar un archivo temporal

    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto,  "fotos_empleados/" . $nombreArchivo_foto); // para mover el archivo a un nuevo destino
        // print_r(move_uploaded_file($tmp_foto, "fotos_empleados/" . $nombreArchivo_foto));
        //print_r($_FILES);
        // print_r($_POST);
    }
    $sentencia->bindParam(":foto", $nombreArchivo_foto); // actualizamos la base datos ese nombre

    // Subir Archivo
    $nombreArchivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : ""; //Armar el nombre del archivo para que nose sobrescriba con otro
    $tmp_cv = $_FILES["cv"]['tmp_name']; // utilizar un archivo temporal

    if ($tmp_cv != '') {
        move_uploaded_file($tmp_cv,  "cv_empleados/" . $nombreArchivo_cv); // para mover el archivo a un nuevo destino

    }



    $sentencia->bindParam(":cv", $nombreArchivo_cv);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);


    $sentencia->execute();
    //print_r($nombreArchivo_foto);
    //print_r($sentencia);
    header("Location:index.php");
}

//Busca los puestos.
$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>




<?php include("../../templates/header.php") ?>

<br />
<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="primernombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
            </div>
            <div class="mb-3">
                <label for="segundonombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre">
            </div>
            <div class="mb-3">
                <label for="primerapellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido">
            </div>
            <div class="mb-3">
                <label for="segundoapellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
            </div>
            <div class="mb-3">



                <label for="foto" class="form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">CV(PDF):</label>
                <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>
            <div class="mb-3">

                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-lg" name="idpuesto" id="idpuesto">
                    <option selected>Selecione una Opción</option>
                    <?php foreach ($lista_tbl_puestos as $registro) { ?>
                        <option value="<?php echo $registro['id'] ?>"><?php echo $registro['nombre_puesto'] ?></option>
                    <?php } ?>
                </select>


            </div>
            <div class="mb-3">
                <label for="fechadeingreso" class="form-label">Fecha de Ingreso</label>
                <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de Ingreso">
            </div>

            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>

    </div>

</div>


<?php include("../../templates/footer.php") ?>
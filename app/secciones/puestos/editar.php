<?php
include("../../db.php");

// Recepcion de datos al formulario
if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto = $registro["nombre_puesto"];
}

// Se hace la Actualizacion
if ($_POST) {
    print_r($_POST);

    // Recolectamos los datos del metodo POST
    $txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
    $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "");
    // Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombre_puesto =:nombredelpuesto  WHERE id =:id");
    // Asignando los valores que vienen del metodo POST
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $mensaje = "Resgistro Actualizado"; //Asigno mensaje
    header("Location:index.php?mensaje=" . $mensaje); //redirecciono y envio variable por url con el mensaje
}




?>

<?php include("../../templates/header.php") ?>
<br />
<div class="card">
    <div class="card-header">
        Editar Puestos
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="txtId" class="form-label">ID:</label>
                    <input type="text" class="form-control" name="txtId" id="txtId" readonly aria-describedby="helpId" placeholder="ID" value="<?php echo $txtId; ?>">

                </div>

                <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
                <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto" value="<?php echo $nombredelpuesto; ?>">
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>




        </form>

    </div>

</div>



<?php include("../../templates/footer.php") ?>
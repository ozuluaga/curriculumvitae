<?php
include("../../db.php");

// Recepcion de datos al formulario
if (isset($_GET['txtId'])) {
    print_r($_GET['txtId']);

    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelusuario = $registro["usuario"];
    $pass = $registro["pass"];
}

// Se hace la Actualizacion
if ($_POST) {
    print_r($_POST);

    // Recolectamos los datos del metodo POST
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $pass = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");

    // Preparar la inserccion de los datos
    $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET usuario =:usuario,  pass=:pass, correo=:correo WHERE id =:id");
    // Asignando los valores que vienen del metodo POST
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":pass", $pass);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    //header("Location:index.php");
    $mensaje = "Registro Actualizado";
    header("Location:index.php?mensaje=" . $mensaje);
}


?>

<?php include("../../templates/header.php") ?>
<br />
<div class="card">
    <div class="card-header">
        Editar Usuarios
    </div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtId" class="form-label">ID</label>
                <input type="text" class="form-control" name="txtId" id="txtId" aria-describedby="helpId" placeholder="Nombre del usuario" value="<?php echo $txtId; ?>">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario" value="<?php echo $nombredelusuario; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña" value="<?php echo $pass; ?>">

            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo" value="<?php echo $registro["correo"]; ?>">

            </div>




            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>




        </form>

    </div>

</div>



<?php include("../../templates/footer.php") ?>
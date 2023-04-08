<?php
include("../../db.php");

// Recepcion de datos al formulario
if (isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId'])) ? $_GET['txtId'] : "";
    $sentencia = $conexion->prepare("SELECT * ,(SELECT nombre_puesto  FROM tbl_puestos WHERE tbl_puestos.id =tbl_empleados.id_puesto limit 1 )as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre = $registro['primer_nombre'];
    $segundonombre = $registro['segundo_nombre'];
    $primerapellido = $registro['primer_apellido'];
    $segundoapellido = $registro['segundo_apellido'];

    $nombreCompleto = $primernombre . " " . $segundonombre . " " . $primerapellido . " " . $segundoapellido;

    $cv = $registro['cv'];
    $foto = $registro['foto'];

    $idpuesto = $registro['id_puesto'];
    $puesto = $registro['puesto'];
    $fechadeingreso = $registro['fecha_ingreso'];

    $fechaInico = new DateTime($fechadeingreso);
    $fechafin = new DateTime(date('y-m-d'));
    $diferencia = date_diff($fechaInico, $fechafin);
}

ob_start(); // a partir de esta linea va a recolectar todo el html y se lo va a pasar a ob_getget_clean()
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion</title>
</head>

<body>
    <h1>Car ta de recomendacion Laboral</h1>
    <br><br>
    Monteria, Colombia a <strong><?php echo  date('d m y'); ?></strong>
    <br><br>
    Reciba un cordial y respetuoso saludo.
    <br><br>
    A traves de estas lineas deseo hacer de su conocimiento que el Sr(a) <strong><?php echo $nombreCompleto; ?></strong>, quien laboro en mi organizacion durante <strong><?php echo $diferencia->y; ?> año(s)</strong> es un ciudadano con una conducta intachable. Ha demostrado ser un gran trabajador, comprometido, responsable y fiel cumplidor de sus tareas.
    Siempre ha manifestado preocupacion por mejorar, capacitarse, y actualizar sus conocimientos.
    <br><br>
    Durante estos años se ha desarrollado como <strong><?php echo $puesto; ?></strong>
    es por ello le sugiero considere esta recomendacion, con la confianza de que estara siempre a la altura de sus compromisos y responsabilidades.
    <br><br>
    sin mas nada a que referirme y, esperando que es misiva sea tomada en cuenta, dejo mi numero de contacto para cualquier informacion de interes.
    <br><br><br><br><br><br><br>

    ________________________ <br>
    Atentamente,
    <br>
    Lic. Olvedo Zuluaga Ramirez



</body>

</html>

<!-- Libreria para convertir el html a pdf -->
<?php
$HTML = ob_get_clean(); // Recibe todo lo que le envia ob_start()
require_once("../../libs/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoeEnabled" => true));
$dompdf->setOptions($opciones);
$dompdf->loadHtml($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
?>
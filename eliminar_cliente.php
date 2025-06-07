<?php
$conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
if (!$conexion) die("Error de conexión");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Puedes agregar verificación adicional si lo deseas
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("Location: conectax.php");
exit;
?>

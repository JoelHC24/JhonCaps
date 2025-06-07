<?php
$conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
if (!$conexion) die("Error de conexión");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];

        $sql = "UPDATE cliente SET nombre=?, apellido=?, correo=?, telefono=? WHERE id_cliente=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $correo, $telefono, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: conectax.php");
        exit;
    }

    $result = mysqli_query($conexion, "SELECT * FROM cliente WHERE id_cliente = $id");
    if (mysqli_num_rows($result) == 1) {
        $cliente = mysqli_fetch_assoc($result);
    } else {
        echo "Cliente no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Modificar Cliente</title></head>
<body>
    <h2>Modificar Cliente</h2>
    <form method="POST">
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required><br><br>
        Apellido: <input type="text" name="apellido" value="<?= htmlspecialchars($cliente['apellido']) ?>" required><br><br>
        Correo: <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required><br><br>
        Teléfono: <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>" required><br><br>
        <input type="submit" value="Guardar Cambios">
    </form>
    <br>
    <a href="conectax.php">Volver al panel</a>
</body>
</html>

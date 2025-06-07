<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8mb4");

$mensaje_error = '';
$mostrar_registro = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'login' && isset($_POST['nombre_login'], $_POST['telefono_login'])) {
        $nombre = trim($_POST['nombre_login']);
        $telefono = trim($_POST['telefono_login']);

        if (empty($nombre) || empty($telefono)) {
            $mensaje_error = "Todos los campos son obligatorios.";
        } else {
            // Consulta preparada para login
            $stmt = mysqli_prepare($conexion, "SELECT * FROM cliente WHERE BINARY TRIM(nombre) = BINARY ? AND BINARY TRIM(telefono) = BINARY ?");
            mysqli_stmt_bind_param($stmt, "ss", $nombre, $telefono);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) == 1) {
                $cliente = mysqli_fetch_assoc($resultado);
                $_SESSION['cliente_nombre'] = $cliente['nombre'];
                mysqli_stmt_close($stmt);
                header("Location: cliente.php");
                exit;
            } else {
                $mensaje_error = "No registrado. Por favor regístrate.";
                $mostrar_registro = true;
            }
            mysqli_stmt_close($stmt);
        }
    }

    if ($accion === 'registrar' && isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['telefono'])) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $correo = trim($_POST['correo']);
        $telefono = trim($_POST['telefono']);

        if (empty($nombre) || empty($apellido) || empty($correo) || empty($telefono)) {
            $mensaje_error = "Todos los campos son obligatorios.";
        } else {
            // Verificar si el cliente ya existe
            $stmt_check = mysqli_prepare($conexion, "SELECT * FROM cliente WHERE LOWER(TRIM(nombre)) = LOWER(?) OR TRIM(telefono) = ?");
            mysqli_stmt_bind_param($stmt_check, "ss", $nombre, $telefono);
            mysqli_stmt_execute($stmt_check);
            $resultado_check = mysqli_stmt_get_result($stmt_check);

            if (mysqli_num_rows($resultado_check) > 0) {
                $mensaje_error = "El cliente ya está registrado.";
                mysqli_stmt_close($stmt_check);
            } else {
                // Registrar cliente
                $stmt = mysqli_prepare($conexion, "INSERT INTO cliente (nombre, apellido, correo, telefono) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $correo, $telefono);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                $_SESSION['cliente_nombre'] = $nombre;
                header("Location: store.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de Sesión o Registro</title>
</head>
<body>
    <?php if (isset($_SESSION['cliente_nombre'])): ?>
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION['cliente_nombre']) ?></h2>
        <form method="post" action="logout.php">
            <input type="submit" value="Cerrar sesión">
        </form>
        <form method="get" action="store.php">
            <input type="submit" value="Continuar a la tienda">
        </form>
    <?php else: ?>
       <h2>Iniciar Sesión</h2>
<?php if (!empty($mensaje_error)): ?>
    <p style="color:red;"><?= htmlspecialchars($mensaje_error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form method="POST" action="cliente.php">
    <input type="hidden" name="accion" value="login">
    <label for="nombre_login">Nombre:</label>
    <input id="nombre_login" name="nombre_login" required><br>
    <label for="telefono_login">Teléfono:</label>
    <input id="telefono_login" name="telefono_login" required><br>
    <input type="submit" value="Iniciar Sesión">
</form>

        <?php if ($mostrar_registro): ?>
            <hr>
            <h2>Registrar Nuevo Cliente</h2>
            <form method="POST" action="cliente.php">
                <input type="hidden" name="accion" value="registrar">
                Nombre: <input name="nombre" required><br>
                Apellido: <input name="apellido" required><br>
                Correo: <input type="email" name="correo" required><br>
                Teléfono: <input name="telefono" required><br>
                <input type="submit" value="Guardar">
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

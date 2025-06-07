<?php
session_start();

$clave_correcta = 'admin123';

if (isset($_SESSION['autenticado_admin']) && $_SESSION['autenticado_admin'] === true) {
    // Conexión a la base de datos
    $conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
    if (!$conexion) die("Error en conexión");

    // Eliminar producto
    if (isset($_GET['eliminar_id'])) {
        $eliminar_id = intval($_GET['eliminar_id']);
        $result_img = mysqli_query($conexion, "SELECT imagen FROM productos WHERE id_producto = $eliminar_id");
        if ($result_img && mysqli_num_rows($result_img) > 0) {
            $row = mysqli_fetch_assoc($result_img);
            $imagen_a_borrar = $row['imagen'];
            if ($imagen_a_borrar && file_exists($imagen_a_borrar)) {
                unlink($imagen_a_borrar);
            }
        }
        mysqli_query($conexion, "DELETE FROM productos WHERE id_producto = $eliminar_id");
        header("Location: conectax.php");
        exit;
    }

    // Crear producto
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = floatval($_POST['precio']);
        $descripcion = $_POST['descripcion'];

        $imagen_nombre = '';
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $tmp_name = $_FILES['imagen']['tmp_name'];
            $imagen_nombre = 'imagenes/' . basename($_FILES['imagen']['name']);
            move_uploaded_file($tmp_name, $imagen_nombre);
        }

        $sql = "INSERT INTO productos (nombre, categoria, precio, descripcion, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssdss", $nombre, $categoria, $precio, $descripcion, $imagen_nombre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: conectax.php");
        exit;
    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Administración</title>
        <style>
            body { font-family: Arial; margin: 30px; }
            .btn-delete {
                padding: 5px 10px;
                background-color: #e74c3c;
                color: white;
                text-decoration: none;
                border-radius: 3px;
            }
            .btn-delete:hover {
                background-color: #c0392b;
            }
            .product-item {
                border: 1px solid #ccc;
                padding: 10px;
                margin-bottom: 8px;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .product-info {
                flex-grow: 1;
                margin-left: 10px;
            }
            img.product-img {
                width: 175px;
                height: 200px;
                object-fit: cover;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }
            th {
                background-color: #f2f2f2;
            }
            .center {
                text-align: center;
            }
        </style>
    </head>
    <body>

        <h2>Crear Producto</h2>
        <form method="post" enctype="multipart/form-data">
            <input name="nombre" placeholder="Nombre" required>
            <input name="categoria" placeholder="Categoría" required>
            <input name="precio" type="number" step="0.01" placeholder="Precio" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input name="imagen" type="file" accept="image/*" required>
            <button type="submit">Crear Producto</button>
        </form>

        <h2>Listado de Productos</h2>
        <?php
        $resultado = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id_producto DESC");
        while ($prod = mysqli_fetch_assoc($resultado)):
        ?>
            <div class="product-item">
                <img class="product-img" src="<?= htmlspecialchars($prod['imagen']) ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>">
                <div class="product-info">
                    <strong><?= htmlspecialchars($prod['nombre']) ?></strong><br>
                    Categoría: <?= htmlspecialchars($prod['categoria']) ?><br>
                    Precio: $<?= number_format($prod['precio'], 2) ?><br>
                    Descripción: <?= htmlspecialchars($prod['descripcion']) ?>
                </div>
                <a href="conectax.php?eliminar_id=<?= $prod['id_producto'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar este producto?');">Eliminar</a>
            </div>
        <?php endwhile; ?>

        <h2>Clientes Registrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
            <?php
            $clientes = mysqli_query($conexion, "SELECT * FROM cliente");
            while ($cliente = mysqli_fetch_assoc($clientes)):
            ?>
            <tr>
                <td><?= $cliente['id_cliente'] ?></td>
                <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                <td><?= htmlspecialchars($cliente['correo']) ?></td>
                <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                <td>
                    <a href="modificar_cliente.php?id=<?= $cliente['id_cliente'] ?>">Modificar</a> |
                    <a href="eliminar_cliente.php?id=<?= $cliente['id_cliente'] ?>" onclick="return confirm('¿Eliminar este cliente?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <br>
        <div class="center">
            <a href="store.php">
                <button style="padding: 10px 20px; font-size: 16px;">Ir a tienda</button>
            </a>
            <br><br>
            <a href="logout.php">Cerrar sesión de administrador</a>
        </div>

    </body>
    </html>
    <?php
    mysqli_close($conexion);
    exit;
}

// Pantalla de login de administrador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clave'])) {
    if ($_POST['clave'] === $clave_correcta) {
        $_SESSION['autenticado_admin'] = true;
        header("Location: conectax.php");
        exit;
    } else {
        $error = "Contraseña incorrecta";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Acceso Administrador</title></head>
<body>
    <h2>Ingrese la contraseña de administrador</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="conectax.php">
        Contraseña: <input type="password" name="clave" required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>

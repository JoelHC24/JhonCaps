<?php
// productos.php
session_start();
$conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
mysqli_set_charset($conexion, "utf8mb4");

$resultado_productos = mysqli_query($conexion, "SELECT * FROM productos");
?>

<html>
<head>
    <title>Productos - Tienda de Gorras</title>
    <style>
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }
        .product-image img {
            width: 175px;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }
        .product-name {
            font-size: 1.1em;
            margin: 10px 0 5px;
        }
        .product-price {
            color: #007BFF;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .btn.add-to-cart {
            display: inline-block;
            padding: 8px 15px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Productos Disponibles</h2>

    <div class="products-container">
    <?php while ($producto = mysqli_fetch_assoc($resultado_productos)): ?>
        <div class="product-card">
            <div class="product-image">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                <?php else: ?>
                    <div style="width:175px; height:200px; background:#eee; display:flex; align-items:center; justify-content:center; color:#999;">Sin imagen</div>
                <?php endif; ?>
            </div>
            <div class="product-info">
                <h3 class="product-name"><?= htmlspecialchars($producto['nombre']) ?></h3>
                <p class="product-price">$<?= number_format($producto['precio'], 2) ?></p>
                <a href="#" class="btn add-to-cart">Añadir al carrito</a>
            </div>
        </div>
    <?php endwhile; ?>
    </div>

</body>
</html>

<?php
mysqli_close($conexion);
?>

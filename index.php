<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CapStyle - Tienda Premium de Gorras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Encabezado -->
    <header>
        <div class="container header-container">
            <a href="#" class="logo">Jhon<span>Caps</span></a>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#acerca">Acerca de</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            <div 
            class="icons-container">
    <a href="#" class="cart-icon">🛒 <span class="cart-count">0</span></a>
    <a href="conectax.php" class="admin-icon">👤 Administrar</a>

    <?php
    session_start();
    if (isset($_SESSION['cliente_nombre'])) {
        echo "<a href='#' class='user-icon'>👤 " . htmlspecialchars($_SESSION['cliente_nombre']) . "</a>";
        echo "<form action='logout.php' method='POST' style='display:inline;'>
                <button type='submit' style='background:none; border:none; color:red; cursor:pointer; padding-left:10px;'>🚪 Cerrar sesión</button>
              </form>";
    } else {
        echo '<a href="cliente.php" class="user-icon">👤 Iniciar sesión</a>';
    }
    ?>
</>



</div>

        </div>
    </header>

    <!-- Sección Hero -->
    <section class="hero">
        <div class="container hero-container">
            <div class="hero-content">
                <h1>Encuentra tu estilo perfecto de gorra</h1>
                <p>Descubre nuestra colección premium de gorras para cada ocasión. Desde snapbacks casuales hasta elegantes fedoras, tenemos la gorra perfecta para completar tu look.</p>
                
            </div>
            <div class="hero-image">
                <img src="logo1.png" alt="Colección destacada de gorras" width="200" height="100"> 
            </div>
        </div>
    </section>

    <!-- Sección de Productos -->
    <section class="products">
        <div class="container">
            <h2 class="section-title">Nuestra <span>Colección</span></h2>
            <div class="product-grid">
                <!-- Producto 1 -->
                <div class="product-card" data-product-id="1" data-product-name="Gorra Negro xd" data-product-category="Deportes" data-product-price="24.99" data-product-image="GorraD.jpg" data-product-description="Una gorra de béisbol clásica con correa ajustable para un ajuste cómodo. Perfecta para salidas casuales y actividades deportivas.">
                    <div class="product-image">
                        <img src="GorraD.jpg" alt="Gorra de Béisbol" width="175" height="200">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Gorra Negro xd</h3>
                        <p class="product-category">Deportes</p>
                        <p class="product-price">$270</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="product-card" data-product-id="2" data-product-name="Snapback Urbano" data-product-category="Casual" data-product-price="29.99" data-product-image="Ny.jpg" data-product-description="Un snapback de moda con visera plana y parte trasera ajustable. Presenta un diseño urbano elegante que complementa cualquier outfit de estilo callejero.">
                    <div class="product-image">
                        <img src="Ny.jpg" alt="Snapback"width="175" height="100">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Snapback Urbano</h3>
                        <p class="product-category">Casual</p>
                        <p class="product-price">$270</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="product-card" data-product-id="3" data-product-name="Fedora Clásico" data-product-category="Formal" data-product-price="39.99" data-product-image="PDora.jpg" data-product-description="Un elegante sombrero fedora hecho de fieltro de lana premium. Presenta una corona pinchada clásica y un ala elegante que añade sofisticación a cualquier atuendo.">
                    <div class="product-image">
                        <img src="PDora.jpg" alt="Fedora" width="175" height="100">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Fedora Clásico</h3>
                        <p class="product-category">Formal</p>
                        <p class="product-price">$300</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="product-card" data-product-id="4" data-product-name="Gorro de Invierno" data-product-category="Invierno" data-product-price="19.99" data-product-image="ARojo.jpg" data-product-description="Un gorro cálido y acogedor hecho de material de punto suave. Perfecto para mantener tu cabeza caliente durante los días fríos de invierno mientras mantienes un look elegante.">
                    <div class="product-image">
                        <img src="ARojo.jpg" alt="Gorro" width="175" height="100">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Gorro de Invierno</h3>
                        <p class="product-category">Invierno</p>
                        <p class="product-price">$280</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 5 -->
                <div class="product-card" data-product-id="5" data-product-name="Sombrero de Cubo de Verano" data-product-category="Verano" data-product-price="22.99" data-product-image="https://placeholder.com/300x300" data-product-description="Un sombrero de cubo ligero perfecto para los días de verano. Proporciona excelente protección solar mientras te mantiene fresco y con estilo en la playa o eventos al aire libre.">
                    <div class="product-image">
                        <img src="PDora.jpg" alt="Sombrero de Cubo">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Sombrero de Cubo de Verano</h3>
                        <p class="product-category">Verano</p>
                        <p class="product-price">$220</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 6 -->
                <div class="product-card" data-product-id="6" data-product-name="Gorra Trucker Vintage" data-product-category="Casual" data-product-price="26.99" data-product-image="https://placeholder.com/300x300" data-product-description="Una gorra trucker clásica con parte trasera de malla para mayor transpirabilidad. Presenta un diseño inspirado en lo vintage que añade un toque retro a tus outfits casuales.">
                    <div class="product-image">
                        <img src="SxNegro.jpg" alt="Gorra Trucker">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Gorra Trucker Vintage</h3>
                        <p class="product-category">Casual</p>
                        <p class="product-price">$260</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 7 -->
                <div class="product-card" data-product-id="7" data-product-name="Sombrero de Paja para Playa" data-product-category="Verano" data-product-price="34.99" data-product-image="https://placeholder.com/300x300" data-product-description="Un sombrero de paja de ala ancha perfecto para días de playa. Proporciona excelente protección solar mientras te mantiene fresco y con estilo durante tus aventuras de verano.">
                    <div class="product-image">
                        <img src="SxCafe.jpg" alt="Sombrero de Paja">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Sombrero de Paja para Playa</h3>
                        <p class="product-category">Verano</p>
                        <p class="product-price">$270</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>

                <!-- Producto 8 -->
                <div class="product-card" data-product-id="8" data-product-name="Gorra Plana de Lana" data-product-category="Casual" data-product-price="32.99" data-product-image="https://placeholder.com/300x300" data-product-description="Una gorra plana clásica hecha de lana premium. Presenta un diseño atemporal que añade un toque de sofisticación a tus outfits casuales o semi-formales.">
                    <div class="product-image">
                        <img src="Ny.jpg" alt="Gorra Plana">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">Gorra Plana de Lana</h3>
                        <p class="product-category">Casual</p>
                        <p class="product-price">$280</p>
                        <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                    </div>
                </div>
                <?php
$conexion = mysqli_connect('localhost', 'root', '12345', 'tienda_gorras');
if (!$conexion) die("Error en conexión");

$resultado = mysqli_query($conexion, "SELECT * FROM productos ORDER BY id_producto DESC");
?>

<section class="products">
    <div class="container">
       
        <div class="product-grid">
            <?php while ($prod = mysqli_fetch_assoc($resultado)): ?>
            <div class="product-card"
                data-product-id="<?= $prod['id_producto'] ?>"
                data-product-name="<?= htmlspecialchars($prod['nombre']) ?>"
                data-product-category="<?= htmlspecialchars($prod['categoria']) ?>"
                data-product-price="<?= number_format($prod['precio'], 2, '.', '') ?>"
                data-product-image="<?= htmlspecialchars($prod['imagen']) ?>"
                data-product-description="<?= htmlspecialchars($prod['descripcion']) ?>">
                <div class="product-image">
                    <img src="<?= htmlspecialchars($prod['imagen']) ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" width="175" height="200">
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?= htmlspecialchars($prod['nombre']) ?></h3>
                    <p class="product-category"><?= htmlspecialchars($prod['categoria']) ?></p>
                    <p class="product-price">$<?= number_format($prod['precio'], 2) ?></p>
                    <a href="#" class="btn add-to-cart">Añadir al carrito</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
mysqli_close($conexion);
?>

            </div>
        </div>
    </section>

    <!-- Sección Acerca de -->
    <section class="about">
        <div class="container about-container">
            <div class="about-image">
                <img src="logo1.png" alt="Acerca de nuestra tienda">
            </div>
            <div id="acerca"  class="about-content">
                <h2>Acerca de </h2>
                <p>Fundada en 2015, CapStyle ha estado proporcionando gorras de calidad premium a entusiastas de la moda en todo el mundo. Nuestra misión es ofrecer sombreros elegantes, cómodos y duraderos para cada ocasión.</p>
                <p>Seleccionamos cuidadosamente materiales de proveedores de confianza y trabajamos con artesanos expertos para asegurar que cada gorra cumpla con nuestros altos estándares. Ya sea que estés buscando una gorra casual para el día a día o una pieza de declaración para un evento especial, tenemos algo para todos.</p>
                <a href="#" class="btn">Saber más</a>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <div  class="container">
            <div class="footer-container">
                <div id="contacto" class="footer-col">
                    <h3>CapStyle</h3>
                    <p>Tu destino para gorras y sombreros de calidad premium. Encuentra el estilo perfecto para expresarte.</p>
                    <div class="social-links">
                        <a href="https://facebook.com/jhonatan.diaz.756859" target="_blank">
                          <img src="https://cdn-icons-png.flaticon.com/24/733/733547.png" alt="Facebook">
                        </a>
                        <a href="https://instagram.com/tu-pagina" target="_blank">
                          <img src="https://cdn-icons-png.flaticon.com/24/733/733558.png" alt="Instagram">
                        </a>
                        <a href="https://twitter.com/tu-pagina" target="_blank">
                          <img src="https://cdn-icons-png.flaticon.com/24/733/733579.png" alt="Twitter">
                        </a>
                        <a href="https://pinterest.com/tu-pagina" target="_blank">
                          <img src="https://cdn-icons-png.flaticon.com/24/733/733646.png" alt="Pinterest">
                        </a>
                      </div>
                      
                </div>
                <div class="footer-col">
                    <h3>Comprar</h3>
                    <ul>
                        <li><a href="#">Todos los Productos</a></li>
                        <li><a href="#">Nuevas Llegadas</a></li>
                        <li><a href="#">Más Vendidos</a></li>
                        <li><a href="#">En Oferta</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3>Categorías</h3>
                    <ul>
                        <li><a href="#">Gorras de Béisbol</a></li>
                        <li><a href="#">Snapbacks</a></li>
                        <li><a href="#">Fedoras</a></li>
                        <li><a href="#">Gorros</a></li>
                        <li><a href="#">Sombreros de Cubo</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="copyright">
                <p>&copy; 2023 CapStyle. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Modal de Producto -->
    <div class="modal-overlay" id="productModal">
        <div class="modal">
            <button class="modal-close" id="modalClose">✕</button>
            <div class="modal-content">
                <div class="modal-image-container">
                    <img src="/placeholder.svg" alt="Imagen del Producto" class="modal-image" id="modalImage">
                </div>
                <div class="modal-product-details">
                    <div class="modal-product-info">
                        <h3 id="modalProductName"></h3>
                        <p class="modal-product-category" id="modalProductCategory"></p>
                        <p class="modal-product-description" id="modalProductDescription"></p>
                        <p class="modal-product-price" id="modalProductPrice"></p>
                    </div>
                    <div class="quantity-selector">
                        <label for="quantity">Cantidad:</label>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" id="decreaseQuantity">-</button>
                            <input type="number" id="quantity" class="quantity-input" value="1" min="1" max="10">
                            <button type="button" class="quantity-btn" id="increaseQuantity">+</button>
                        </div>
                    </div>
                    <div class="modal-actions">
                        <button class="btn modal-add-to-cart" id="modalAddToCart">Añadir al Carrito</button>
                        <button class="btn" style="background-color: #2980b9;">Comprar Ahora</button>
                    </div>
                </div>
            </div>
            <!-- Botones para seleccionar tallas -->
            <div class="size-selector">
                <p>Selecciona tu talla:</p>
                <div class="size-buttons">
                    <button class="size-btn" data-size="7">7</button>
                    <button class="size-btn" data-size="7⅛">7⅛</button>
                    <button class="size-btn" data-size="7¼">7¼</button>
                    <button class="size-btn" data-size="7⅜">7⅜</button>
                    <button class="size-btn" data-size="7½">7½</button>
                    <button class="size-btn" data-size="7⅝">7⅝</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal del Carrito -->
    <div class="modal-overlay" id="cartModal">
        <div class="modal cart-modal">
            <button class="modal-close" id="cartModalClose">✕</button>
            <h2>Tu Carrito</h2>
            <div id="cartItems"></div>
            <div class="cart-total">Total: $<span id="cartTotal">0.00</span></div>
            <div class="cart-actions">
                <button class="btn" id="continueShoppingBtn">Continuar Comprando</button>
                <button class="btn" id="checkoutBtn" style="background-color: #2980b9;">Finalizar Compra</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
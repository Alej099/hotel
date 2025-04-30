<?php
// Conectar a la base de datos
include 'conexion.php'; // Asegúrate de tener tu archivo de conexión

// Consultar habitaciones
$stmt = $conexion->query("SELECT id, nombre, descripcion, precio, disponibilidad, imagen FROM habitaciones");
$habitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php if (isset($_GET['mensaje'])): ?>
    <div class="alerta-avisos">
        <?= htmlspecialchars($_GET['mensaje']) ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones - The Ocean View Resort</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="fonts/stylesheet.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/magnific-popup.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="header-row">
                <div class="header-mobile-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="The Ocean View Resort" style="width: 120px; height: auto;">
                    </a>
                </div>

                <div class="hamburger">
                    <span></span><span></span>
                </div>

                <div class="header-desc">The Ocean View Resort</div>

                <div class="header-right">
                    <div class="header-info">
                        <img src="images/location.svg" alt="Location">
                        <span>Greenbe street 5B, Latvia</span>
                    </div>
                    <a href="tel:79504575654" class="header-info">
                        <img src="images/phone.svg" alt="Phone">
                        <span>+7 950 457 5654</span>
                    </a>
                    <div class="header-social">
                        <a href="#"><img src="images/social-twitter.svg" alt="Twitter"></a>
                        <a href="#"><img src="images/social-facebook.svg" alt="Facebook"></a>
                        <a href="#"><img src="images/social-telegram.svg" alt="Telegram"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-row">
                <div class="header-logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="The Ocean View Resort" style="width: 120px; height: auto;">
                    </a>
                </div>

                <nav class="header-nav">
                    <ul>
                        <li><a href="index.html#s-about">Acerca de nosotros</a></li>
                        <li><a href="index.html#s-services">Nuestros servicios</a></li>
                        <li><a href="index.html#s-gallery">Galería</a></li>
                        <li><a href="index.html#s-testimonials">Nuestros hoteles</a></li>
                        <li><a href="habitaciones.html" class="active">Habitaciones</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<section class="s-about" id="s-habitaciones">
    <div class="container">
        <h2 class="center-title wow fadeIn">Habitaciones Disponibles</h2>

        <div class="services-row">

            <?php foreach ($habitaciones as $hab): ?>
              <div class="services-item wow fadeIn" data-wow-delay="0.3s">
                <div class="services-thumb">
                <img src="<?= htmlspecialchars( $hab['imagen']) ?>" 
        alt="<?= htmlspecialchars($hab['nombre']) ?>">
                </div>
                <div class="services-body">
                  <h4 class="services-title"><?= htmlspecialchars($hab['nombre']) ?></h4>
                  <div class="services-desc">
                    <?= htmlspecialchars($hab['descripcion']) ?>
                  </div>
                  <div class="services-price">
                    <strong>Precio:</strong> $<?= htmlspecialchars($hab['precio']) ?> por noche
                  </div>

                  <a class="btn-editar" href="editar_habitacion.php?id=<?= $hab['id'] ?>">Editar información</a>

                </div>
              </div>
            <?php endforeach; ?>

            </div> 

        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php" class="def-btn">Volver al Inicio</a>
        </div>

    </div>
</section>

 
  
  <!-- JavaScript para llenar el formulario con los datos -->
  <script>
    document.querySelectorAll('.open-edit-modal').forEach(btn => {
      btn.addEventListener('click', function () {
        document.getElementById('edit-title').value = this.getAttribute('data-title');
        document.getElementById('edit-desc').value = this.getAttribute('data-desc');
        document.getElementById('edit-price').value = this.getAttribute('data-price');
      });
    });
  </script>


<footer class="site-footer">
    <div class="container">

        <div class="footer-row">

            <div class="footer-left">
                <div class="footer-logo">
                    <a href="#">
                        <img src="images/logo.png" alt="Construction"style="width: 120px; height: auto;">
                    </a>
                </div>
                <div class="footer-desc">
                    <strong>The ocean view resort</strong> "Vistas que enamoran, momentos que perduran."
                </div>
            </div>

            <div class="footer-right">
                <nav class="footer-nav">
                    <h5 class="footer-title">Nuestros servicios</h5>
                    <ul>
                        <li><a href="#">Alojamiento</a></li>
                        <li><a href="#">Restaurante y Bar</a></li>
                        <li><a href="#">Bienestar y Relax</a></li>
                        <li><a href="#">Servicio al Huesped</a></li>
                        <li><a href="#">Negocios y Eventos</a></li>
                        <li><a href="#">Reservas y Promociones</a></li>
                    </ul>
                </nav>

                <div class="footer-nav">
                    <h5 class="footer-title">Horario</h5>
                    <ul>
                        <li>Lunes: 8:30 am - 9:00 pm</li>
                        <li>Martes: 8:00 am - 9:00 pm</li>
                        <li>Miercoles: 8:00 am - 9:00 pm</li>
                        <li>Jueves: 8:30 am - 9:00 pm</li>
                        <li>Viernes: 10:00 am - 4:00 pm</li>
                        <li>Sabado: 9:00 am - 12:30 pm</li>
                        <li>Domingo: Closed</li>
                    </ul>
                </div>

                <div class="footer-nav">
                    <h5 class="footer-title">Contactos</h5>
                    <div class="footer-info-item">
                        <div class="footer-info-icon"><img src="images/location-gray.svg" alt="Location"></div>
                        <div class="footer-info-text">Centro Comercial </div>
                    </div>
                    <a href="tel:79504575654" class="footer-info-item">
                        <div class="footer-info-icon"><img src="images/phone-gray.svg" alt="Phone"></div>
                        <div class="footer-info-text">+7 950 457 5654</div>
                    </a>

                    <div class="footer-social">
                        <a href="#">
                            <img src="images/social-twitter-gray.svg" alt="Twitter">
                        </a>
                        <a href="#">
                            <img src="images/social-vk-gray.svg" alt="Вконтакте">
                        </a>
                        <a href="#">
                            <img src="images/social-facebook-gray.svg" alt="Facebook">
                        </a>
                        <a href="#">
                            <img src="images/social-telegram-gray.svg" alt="Telegram">
                        </a>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="footer-copyright">
            <div class="copyright-text">Copyright © 2023 Construction. All rights reserved</div>
        </div>

    </div>
</footer>

<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/magnific-popup.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>

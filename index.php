<?php
require_once __DIR__ . '/controllers/RouteController.php';

$router = new RouteController();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Draftosaurus - Juego de Mesa Digital</title>

  <!-- Bootstrap y fuentes -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilos propios -->
  <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
  <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
  <link rel="stylesheet" href="<?= $router->asset('assets/css/carousel.css') ?>">
  <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">

  <!-- Scripts propios -->
  <script src="<?= $router->asset('scripts/main.js') ?>" defer></script>
  <script src="<?= $router->asset('scripts/auth.js') ?>" defer></script>
</head>
<body>
  <!-- Navbar -->
  <?php include __DIR__ . '/views/navbar.php'; ?>

  <!-- Main Content -->
 <div class="main-content">
  <div class="container">
    <div class="hero-section">
      <div class="row align-items-center w-100">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <?php include __DIR__ . '/views/carousel.php'; ?>
        </div>
        <div class="col-lg-6 text-center text-lg-start">
          <h1 class="hero-title">UN JUEGO PARA TODA LA FAMILIA</h1>
          <p class="hero-subtitle">
            Sumérgete en una aventura jurásica épica...
          </p>
          <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal">
            <i class="fas fa-play me-2"></i>INICIAR SESIÓN
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


  <!-- Footer -->
  <?php include __DIR__ . '/views/footer.php'; ?>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">
            <i class="fas fa-user-circle me-2"></i>Iniciar Sesión
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Usuario" required>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Contraseña" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-custom">Entrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

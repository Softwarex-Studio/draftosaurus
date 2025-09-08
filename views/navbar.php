<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definimos la base del proyecto (ajustar según tu carpeta)
$baseUrl = '/draftosaurus/'; 
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$baseUrl = (isset($baseUrl)) ? $baseUrl : '';
?>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
  <div class="container">
    <a class="navbar-brand" href="<?= $baseUrl ?>index.php">
      <div class="dino-icon">
        <i class="fas fa-dragon" style="color: black; font-size: 1.2rem;"></i>
      </div>
      DRAFTOSAURUS
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>index.php"><i class="fas fa-home me-2"></i>Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>views/rules.php"><i class="fas fa-book me-2"></i>Reglas</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $baseUrl ?>views/ranking.php"><i class="fas fa-trophy me-2"></i>Ranking</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalRegistro"><i class="fas fa-user-plus me-2"></i>Registro</a></li>
      </ul>
    </div>

    <div class="d-none d-lg-block ms-auto text-white" id="welcome">
      <i class="fas fa-user-circle me-2"></i>
      <?php if(isset($_SESSION['Username'])): ?>
        Bienvenido <?= htmlspecialchars($_SESSION['Username']) ?>
      <?php else: ?>
        Bienvenido Usuario
      <?php endif; ?>
    </div>
  </div>
</nav>


<!-- Modal de Registro -->
<div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="modalRegistroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Centrado verticalmente igual que login -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistroLabel">
          <i class="fas fa-user-circle me-2"></i>Registro
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Nombre" required>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
              <input type="text" class="form-control" placeholder="Apellido" required>
            </div>
          </div>
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" class="form-control" placeholder="Correo electrónico" required>
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
        <button type="button" class="btn btn-custom">Crear cuenta</button>
      </div>
    </div>
  </div>
</div>

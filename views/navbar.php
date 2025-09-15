<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/RouteController.php';

$userController = new UserController();
$router = new RouteController();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Manejar logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $userController->logout();
}

// Manejar login
$loginError = '';
$showLoginModal = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($userController->login($email, $password)) {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $loginError = 'Correo o contraseña incorrectos';
        $showLoginModal = true;
    }
}

// Manejar registro
$registerError = '';
$showRegisterModal = false;

// Valores previos para mantener inputs en caso de error
$prevData = ['first_name'=>'','last_name'=>'','nickname'=>'','email'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $data = [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name'  => $_POST['last_name'] ?? '',
        'nickname'   => $_POST['nickname'] ?? '',
        'email'      => $_POST['email'] ?? '',
        'password'   => $_POST['password'] ?? '',
    ];

    $prevData = $data;

    $result = $userController->register($data);

    if ($result['success']) {
        echo "<script>alert('Cuenta creada con éxito');</script>";
        // Limpiar los campos
        $prevData = ['first_name'=>'','last_name'=>'','nickname'=>'','email'=>''];
    } else {
        $registerError = $result['error'] ?? 'Error al registrar';
        $showRegisterModal = true;
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= $router->route('index.php') ?>">
            <div class="dino-icon"><i class="fas fa-dragon" style="color:black;"></i></div>
            DRAFTOSAURUS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= $router->route('index.php') ?>"><i
                            class="fas fa-home me-2"></i>Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $router->route('views/rules.php') ?>"><i
                            class="fas fa-book me-2"></i>Reglas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $router->route('views/ranking.php') ?>"><i
                            class="fas fa-trophy me-2"></i>Ranking</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                        data-bs-target="#modalRegistro"><i class="fas fa-user-plus me-2"></i>Registro</a></li>
            </ul>
        </div>

        <div class="ms-auto d-flex gap-2">
            <?php if($userController->checkLogin()): ?>
            <div class="dropdown">
                <a class="btn btn-custom dropdown-toggle" href="#" role="button" id="userMenu" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i><?= htmlspecialchars($_SESSION['nickname']) ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <li><a class="dropdown-item" href="<?= $router->route('views/userProfile.php') ?>"><i
                                class="fas fa-id-badge me-2"></i>Mi Perfil</a></li>
                    <li>
                        <form method="post" style="margin:0;">
                            <button type="submit" name="logout" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <?php else: ?>
            <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#loginModal">
                <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-circle me-2"></i>Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if($loginError): ?><div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="login" value="1">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Correo electrónico"
                                required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-custom">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if($showLoginModal): ?>
    new bootstrap.Modal(document.getElementById('loginModal')).show();
    <?php endif; ?>
});
</script>

<!-- Modal Registro -->
<div class="modal fade" id="modalRegistro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-circle me-2"></i>Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php if($registerError): ?><div class="alert alert-danger"><?= htmlspecialchars($registerError) ?>
                </div><?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="register" value="1">
                    <?php
          $fields = ['first_name'=>'Nombre','last_name'=>'Apellido','nickname'=>'Nickname','email'=>'Correo electrónico'];
          foreach($fields as $key=>$label):
          ?>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="<?= $key ?>" placeholder="<?= $label ?>"
                                value="<?= htmlspecialchars($prevData[$key] ?? '') ?>" required>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-custom">Crear cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if($showRegisterModal): ?>
    new bootstrap.Modal(document.getElementById('modalRegistro')).show();
    <?php endif; ?>
});
</script>
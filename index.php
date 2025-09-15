<?php
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/RouteController.php';

$router = new RouteController();
$userController = new UserController();
session_start();

$loginError = '';
$showLoginModal = false;

// 🔹 Manejo del login desde el modal usando email + password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!$userController->login($email, $password)) {
        $loginError = "Correo o contraseña incorrectos";
        $showLoginModal = true; // Reabre la modal
    } else {
        // se el login es correcto, recarga para mostrar nickname en navbar
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draftosaurus - Juego de Mesa Digital</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/carousel.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">
    <script src="<?= $router->asset('scripts/main.js') ?>" defer></script>
    <script src="<?= $router->asset('scripts/auth.js') ?>" defer></script>
</head>

<body>
    <?php include __DIR__ . '/views/navbar.php'; ?>

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

                        <a href="<?= $router->asset('views/tracking.php') ?>" class="btn btn-custom mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>Seguimiento
                        </a>

                        <?php if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])): ?>
                        <a href="<?= $router->asset('views/game.php') ?>" class="btn btn-custom mb-3">
                            <i class="fas fa-play me-2"></i>Comenzar Partida
                        </a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/views/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/RouteController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userController = new UserController();
$router = new RouteController();

// Manejar logout desde dropdown
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $userController->logout();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Draftosaurus Rules</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/rules.css') ?>">

    <script src="<?= $router->asset('../scripts/main.js') ?>" defer></script>
</head>

<body>
    <div class="home-container">
        <?php include __DIR__ . '/navbar.php'; ?>

        <div class="container my-4">
            <h1 class="title text-center">Reglas de Juego</h1>

            <div class="accordion accordion-flush index my-4" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Índice
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="#preparation">1. Preparación</a></li>
                                <li><a href="#develop">2. Desarrollo de la Partida</a></li>
                                <li><a href="#places">3. Recintos</a></li>
                                <li><a href="#summer">4. Tablero de Verano</a></li>
                                <li><a href="#dice">5. El Dado - Final de Partida</a></li>
                                <li><a href="#winter">6. Tablero de Invierno</a></li>
                                <li><a href="#extra">7. Modo 2 Jugadores</a></li>
                                <li><a href="#video">8. Video Tutorial</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rules-galery text-center mb-5">
            <img src="<?= $router->asset('assets/img/reglamento.png') ?>" class="rules mb-3" alt="rules main" />
            <img src="<?= $router->asset('assets/img/rules1.png') ?>" class="rules mb-3" id="preparation"
                alt="rules page 1" />
            <img src="<?= $router->asset('assets/img/rules2.png') ?>" class="rules mb-3" id="develop"
                alt="rules page 2" />
            <img src="<?= $router->asset('assets/img/rules3.png') ?>" class="rules mb-3" id="places"
                alt="rules page 3" />
            <img src="<?= $router->asset('assets/img/rules4.png') ?>" class="rules mb-3" id="summer"
                alt="rules page 4" />
            <img src="<?= $router->asset('assets/img/rules5.png') ?>" class="rules mb-3" id="dice" alt="rules page 5" />
            <img src="<?= $router->asset('assets/img/rules6.png') ?>" class="rules mb-3" id="winter"
                alt="rules page 6" />
            <img src="<?= $router->asset('assets/img/rules7.png') ?>" class="rules mb-3" id="extra"
                alt="rules page 7" />
        </div>

        <div class="container mb-5" id="video">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/-ZyFqRNkiAU" title="Draftosaurus - Tutorial"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
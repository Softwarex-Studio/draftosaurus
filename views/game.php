<?php
session_start();
require_once __DIR__ . '/../controllers/RouteController.php';
$router = new RouteController();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Draftosaurus Play Zone</title>
    <link rel="icon" href="<?= $router->asset('assets/img/dino.png') ?>" type="image/png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/game_board.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">

    <script src="<?= $router->asset('scripts/main.js') ?>" defer></script>
</head>

<body>

    <?php include __DIR__ . '/navbar.php'; ?>


    <div id="game-board">
        <?php include __DIR__ . '/game_board.php'; ?>
    </div>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
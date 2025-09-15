<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/RouteController.php';

$router = new RouteController();
$userController = new UserController();

// Verificar si se paso un nickname por GET
$nickname = $_GET['nickname'] ?? null;
if (!$nickname) {
    header("Location: " . $router->asset('index.php'));
    exit();
}

// Obtener datos del usuario por nickname
$userData = $userController->getNickname($nickname);
if (!$userData) {
    header("Location: " . $router->asset('index.php'));
    exit();
}

// Conexion a la DB
global $db;

// Obtener stats del usuario
$stmt = $db->prepare("
    SELECT 
        COUNT(gp.game_id) AS partidas,
        SUM(CASE WHEN g.winner_id = gp.user_id THEN 1 ELSE 0 END) AS victorias,
        SUM(gp.score) AS puntaje_total
    FROM GamePlayers gp
    INNER JOIN Games g ON gp.game_id = g.game_id
    WHERE gp.user_id = :user_id
");

$stmt->bindParam(':user_id', $userData['user_id'], PDO::PARAM_INT);
$stmt->execute();
$stats = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perfil de <?= htmlspecialchars($userData['nickname']) ?> - Draftosaurus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/navbar.php'; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Nombre:</div>
                        <div class="col-7"><?= htmlspecialchars($userData['first_name']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Apellido:</div>
                        <div class="col-7"><?= htmlspecialchars($userData['last_name']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Nickname:</div>
                        <div class="col-7"><?= htmlspecialchars($userData['nickname']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Partidas jugadas:</div>
                        <div class="col-7"><?= $stats['partidas'] ?? 0 ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Victorias:</div>
                        <div class="col-7"><?= $stats['victorias'] ?? 0 ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5 fw-bold text-end">Puntaje total:</div>
                        <div class="col-7"><?= $stats['puntaje_total'] ?? 0 ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include __DIR__ . '/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
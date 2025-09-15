<?php
require_once __DIR__ . '/../controllers/RankingController.php';
require_once __DIR__ . '/../controllers/RouteController.php';

$rankingController = new RankingController();
$router = new RouteController();

// Obtener los jugadores
$jugadores = $rankingController->getPlayers();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draftosaurus - Ranking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= $router->asset('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/ranking.css') ?>">
    <link rel="stylesheet" href="<?= $router->asset('assets/css/footer.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/navbar.php'; ?>

    <main class="container mt-1 pt-5">
        <h1 class="text-center mb-4">Ranking de Jugadores</h1>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Usuario</th>
                    <th>Partidas</th>
                    <th>Victorias</th>
                    <th>Puntaje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $jugador): ?>
                <tr>
                    <th>
                        <?php
                                if ($jugador['pos'] == 1) echo '<i class="bi bi-trophy-fill text-warning"></i> 1';
                                elseif ($jugador['pos'] == 2) echo '<i class="bi bi-trophy-fill text-secondary"></i> 2';
                                elseif ($jugador['pos'] == 3) echo '<i class="bi bi-trophy-fill" style="color: peru;"></i> 3';
                                else echo $jugador['pos'];
                            ?>
                    </th>
                    <!-- Usuario como link al perfil falta arreglarlo -->
                    <td>
                        <a
                            href="<?= $router->asset('views/userProfile.php?nickname=' . urlencode($jugador['nickname'])) ?>">
                            <?= htmlspecialchars($jugador['nickname']) ?>
                        </a>



                    </td>
                    <td><?= $jugador['partidas'] ?></td>
                    <td><?= $jugador['victorias'] ?></td>
                    <td><?= $jugador['puntaje'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
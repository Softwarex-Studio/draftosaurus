<?php
require_once __DIR__ . '/../models/PlayerModel.php';
require_once __DIR__ . '/RouteController.php';

class RankingController {
    private $model;
    private $router;

    public function __construct() {
        $this->model = new PlayerModel();
        $this->router = new RouteController();
    }

    // Trae el ranking desde la DB y renderiza la vista
    public function show() {
        $jugadores = $this->model->getRanking();
        $this->router->render('ranking', [
            'jugadores' => $jugadores,
            'router' => $this->router
        ]);
    }

    // Para obtener los jugadores sin renderizar (opcional)
    public function getPlayers() {
        return $this->model->getRanking();
    }
}
?>

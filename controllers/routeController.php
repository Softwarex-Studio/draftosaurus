<?php
class RouteController {
    private $baseUrl;

    public function __construct() {
        $this->baseUrl = $this->getBaseUrl();
    }

    public function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        return rtrim($protocol . $host . $scriptName, '/') . '/';
    }

    public function asset($path) {
        return $this->baseUrl . ltrim($path, '/');
    }

    public function render($view, $data = []) {
        $data['router'] = $this; // ⚠ pasamos $router a la vista
        extract($data);
        include __DIR__ . "/../views/$view.php";
    }
}
?>

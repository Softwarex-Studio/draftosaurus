<?php
class RouteController {
    private $baseUrl;

    public function __construct() {
        $this->baseUrl = $this->getBaseUrl();
    }

    private function getBaseUrl() {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $projectFolder = '/draftosaurus';

        return $protocol . $host . $projectFolder . '/';
    }

    public function asset($path) {
        return $this->baseUrl . ltrim($path, '/');
    }

    public function route($path) {
        return $this->baseUrl . ltrim($path, '/');
    }

    public function render($view, $data = []) {
        $data['router'] = $this; 
        extract($data);
        include __DIR__ . "/../views/$view.php";
    }
}
?>
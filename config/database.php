<?php
// config/Database.php

try {
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=draftosaurus_db;charset=utf8',
        'root',
        '' // tu password, por defecto XAMPP suele ser vacía
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

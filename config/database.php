<?php

try {
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=draftosaurus_db;charset=utf8',
        'root',
        '' // contraseña vacia por defecto en xampp, se cambia si se quiere.
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
<?php
require_once __DIR__ . '/config/database.php'; // Traemos la base de datos $db

// Seleccionamos todos los usuarios
$stmt = $db->query("SELECT user_id, password_hash FROM Users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    $plainPassword = $user['password_hash']; // pass en texto plano
    $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT); // se hashe la pass

    $update = $db->prepare("UPDATE Users SET password_hash = :hash WHERE user_id = :id");
    $update->bindParam(':hash', $hashedPassword);
    $update->bindParam(':id', $user['user_id']);
    $update->execute();

    echo "Usuario ID {$user['user_id']} actualizado.<br>";
}

echo "¡Todas las contraseñas han sido hasheadas!";
USE draftosaurus_db;

INSERT INTO Users (first_name, last_name, email, password_hash, active, is_admin) VALUES
('Marcos', 'Sierra', 'marcos.sierra@gmail.com', 'bcrypt_placeholder', TRUE, TRUE),
('Nacho', 'Alonso', 'nacho.alonso@gmail.com', 'bcrypt_placeholder', TRUE, FALSE),
('Marcel', 'Barrios', 'marcel.barrios@gmail.com', 'bcrypt_placeholder', TRUE, FALSE),
('Gabriel', 'Barboza', 'gabriel.barboza@gmail.com', 'bcrypt_placeholder', TRUE, FALSE),
('Luis', 'Fagundez', 'luis.fagundez@gmail.com', 'bcrypt_placeholder', TRUE, FALSE);

INSERT INTO Games (date_played, winner_id) VALUES
(CURDATE(), NULL),
(DATE_SUB(CURDATE(), INTERVAL 1 DAY), NULL),
(DATE_SUB(CURDATE(), INTERVAL 2 DAY), NULL);

-- Insertar jugadores por partida con puntaje inicial 0
-- Partida 1
USE draftosaurus_db;

-- Partida 1
INSERT INTO GamePlayers (game_id, user_id, score) VALUES
(1, 1, 150),  -- Marcos
(1, 2, 120),  -- Nacho
(1, 3, 100),  -- Marcel
(1, 4, 90),   -- Gabriel
(1, 5, 80);   -- Luis

-- Partida 2
INSERT INTO GamePlayers (game_id, user_id, score) VALUES
(2, 1, 130),  -- Marcos
(2, 2, 140),  -- Nacho
(2, 3, 110),  -- Marcel
(2, 4, 95),   -- Gabriel
(2, 5, 85);   -- Luis

-- Partida 3
INSERT INTO GamePlayers (game_id, user_id, score) VALUES
(3, 1, 160),  -- Marcos
(3, 2, 135),  -- Nacho
(3, 3, 120),  -- Marcel
(3, 4, 100),  -- Gabriel
(3, 5, 90);   -- Luis

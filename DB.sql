USE heroku_25a5b06ae795ac4;

CREATE TABLE IF NOT EXISTS login (
  id INT NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(25) NOT NULL UNIQUE,
  password VARCHAR(40) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- INSERT INTO login (usuario, password) VALUES ("usuario1", SHA1("usuario1"));

CREATE TABLE IF NOT EXISTS productos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(25) NOT NULL UNIQUE,
  descripcion TEXT NOT NULL,
  precio INT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO productos (nombre, descripcion, precio) VALUES ("Doritos Rojos", "Papas caseras de la marca sabritas", 15);
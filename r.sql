

USE yoasobi;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL
);

INSERT INTO utilisateurs (email, mdp) VALUES ('exemple@yoasobi.com', PASSWORD('motdepasse123'));

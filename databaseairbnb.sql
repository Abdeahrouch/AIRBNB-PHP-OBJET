CREATE TABLE
    IF NOT EXISTS `user` (
        `id` INT(10) NOT NULL AUTO_INCREMENT,
        `password` VARCHAR(150) NOT NULL,
        `is_hote` BOOLEAN NOT NULL,
        `nom` VARCHAR(150) NOT NULL,
        `prenom` VARCHAR(150) NOT NULL,
        `date_inscription` INT(10) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        PRIMARY KEY (`id`)
    );



CREATE TABLE
    IF NOT EXISTS `type_de_logement` (
        `id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(150) NOT NULL
    );

CREATE TABLE
    IF NOT EXISTS `equipement` (
        `id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `label` VARCHAR(150) NOT NULL
    );

    -- Table annonces
CREATE TABLE IF NOT EXISTS `annonces` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `user_id` INT(10) NOT NULL,
    `titre` VARCHAR(150) NOT NULL,
    `pays` VARCHAR(150) NOT NULL,
    `ville` VARCHAR(150) NOT NULL,
    `adresse` VARCHAR(150) NOT NULL,
    `type_de_logement_id` INT(10) NOT NULL,
    `taile` INT(10) NOT NULL,
    `nbr_de_pieces` INT(10) NOT NULL,
    `description` VARCHAR(150) NOT NULL,
    `prix_par_nuit` INT(10) NOT NULL,
    `nbr_de_couchages` INT(10) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`type_de_logement_id`) REFERENCES `type_de_logement`(`id`)
);

-- Table reservations
CREATE TABLE IF NOT EXISTS `reservations` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `user_id` INT(10) NOT NULL,
    `annonces_id` INT(10) NOT NULL,
    `date_debut` INT(10) NOT NULL,
    `date_fin` INT(10) NOT NULL,
    `nbr_de_personne` INT(10) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`annonces_id`) REFERENCES `annonces`(`id`)
);

-- Table photos
CREATE TABLE IF NOT EXISTS `photos` (
    `annonces_id` INT(10) NOT NULL,
    `image_path` VARCHAR(150) NOT NULL,
    FOREIGN KEY (`annonces_id`) REFERENCES `annonces`(`id`)
);


-- Table annonces_equipement
CREATE TABLE IF NOT EXISTS `annonces_equipement` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `equipement_id` INT(10) NOT NULL,
    `annonces_id` INT(10) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`equipement_id`) REFERENCES `equipement`(`id`),
    FOREIGN KEY (`annonces_id`) REFERENCES `annonces`(`id`)
);


INSERT INTO `type_de_logement` (`id`, `label`) VALUES
    (1, 'Appartement'),
    (2, 'Maison'),
    (3, 'Studio'),
    (4, 'Chambre '),
    (5, 'Maison '),
    (19, 'Villa');


INSERT INTO `equipement` (`id`, `label`) VALUES
    (1, 'Wi-Fi'),
    (2, 'Télévision'),
    (3, 'Climatisation'),
    (4, 'Chauffage'),
    (5, 'Cuisine équipée'),
    (6, 'Réfrigérateur'),
    (7, 'Machine à café'),
    (8, 'Micro-ondes'),
    (9, 'Lave-vaisselle'),
    (32, 'Lit bébé'),
    (33, 'Chaise haute'),
    (34, 'Jouets'),
    (35, 'Console de jeux'),
    (36, 'Lecteur DVD');

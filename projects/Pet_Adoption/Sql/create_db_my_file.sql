DROP DATABASE IF EXISTS fswd14_cr11_petadoption_AndrewGorman;
CREATE DATABASE IF NOT EXISTS `fswd14_cr11_petadoption_AndrewGorman` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd14_cr11_petadoption_AndrewGorman`;

CREATE  TABLE `fswd14_cr11_petadoption_AndrewGorman`.`user` (
`id`  INT(11) NOT NULL AUTO_INCREMENT,
`first_name` VARCHAR(255) NOT NULL ,
`last_name` VARCHAR(255) NOT  NULL,
`password` VARCHAR (255) NOT NULL,
`date_of_birth` DATE NOT NULL,
`user_address`VARCHAR (255), 
`phone_number`VARCHAR (55), 
`email` VARCHAR(255) NOT  NULL,
`picture` VARCHAR(255) NULL,
`status` VARCHAR(4) NOT NULL DEFAULT 'user' ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

CREATE TABLE animals (
pet_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
pet_name VARCHAR(128) NOT NULL,
picture VARCHAR(55) NULL,
location VARCHAR(255) NOT NULL,
description VARCHAR(255) NOT NULL,
size VARCHAR(10) NOT NULL,
age INT(3) NOT NULL,
hobbies VARCHAR(255) NOT NULL,
breed VARCHAR(128) NOT NULL,
status VARCHAR(22) NOT NULL DEFAULT 'available',
species VARCHAR(55) NOT NULL 
);

INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Paul', 'bear1.jpg', '23 Praterstrasse', 'big cuddly polar bear. Loves cool temperatures', 'large', 12, 'hunting, fishing, long-distance roaming.', 'ursus maritimus Domesticus', 'available', 'large mammal');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Carl', 'cat1.jpg', '24 Praterstrasse', 'small cuddly pussycat. Loves warm temperatures', 'small', 9, 'sitting in the window, fishing, purring', 'felis catus pussicus', 'available', 'cat');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Camille', 'chameleon1.jpg', '25 Praterstrasse', 'chameleon master of disguise. Loves warm temperatures', 'small', 4, 'listening to Herbie Hancock, hiding, sticking tongue out', 'reptilia iguania squamata chamaelionidae', 'available', 'small reptile');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Dingo', 'dog1.jpg', '26 Praterstrasse', 'playfull canine buddy. Loves warm temperatures', 'large', 5, 'chasing balls, fetching slippers', 'canis familiaris', 'available', 'dog');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Harald', 'hamster1.jpg', '27 Praterstrasse', 'furry hamster friend. Loves warm temperatures', 'small', 2, 'running in wheels, eating seeds, sleeping', 'rodentia cricetinae', 'available', 'rodent');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Lenny', 'lemur1.jpg', '28 Praterstrasse', 'long-tailed Lemur. Loves warm temperatures', 'large', 6, 'climbing, eating fruit, hanging out', 'lemures lustigus', 'available', 'primate');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Minna', 'monkey1.jpg', '29 Praterstrasse', 'cheeky monkey chum. Loves warm temperatures', 'small', 3, 'stealing hats, climbing, eating fruit, hanging out', 'siricus simia', 'available', 'primate');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Peter', 'parrot1.jpg', '30 Praterstrasse', 'chatty chipper parrot. loves warm temperatures', 'small', 13, 'squawking and talking. Sitting on pirate shoulders', 'pionites melanocephalus', 'available', 'bird');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Terry', 'terrapin1.jpg', '31 Praterstrasse', 'timid terrapin. Loves land and water', 'small', 33, 'swimming, hiding in shell.', 'malaclemys terrapin terrapin', 'available', 'reptile');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Toni', 'tiger1.jpg', '32 Praterstrasse', 'bengal white tiger. Requires 9kg meat per day', 'large', 13, 'stealth-hunting. Swamp-swimming. Sunbathing.', 'panthera tigris tigris', 'available', 'large cat');
INSERT INTO animals (pet_name, picture, location, description, size, age, hobbies, breed, status, species)
VALUES ('Freddy', 'frog1.jpg', '33 Praterstrasse', 'amphibious amigo. Loves slimy wet swampy areas', 'small', 1, 'sitting on logs. Croaking. Mating and swimming', 'canus lupis', 'available', 'amphibian');

CREATE TABLE pet_adoption(
adoption_id  INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
fk_user_id INT(11),
fk_pet_id INT(11),
adoption_date TIMESTAMP,
FOREIGN KEY (fk_user_id) REFERENCES user (id) ON DELETE SET NULL,
FOREIGN KEY (fk_pet_id) REFERENCES animals (pet_id) ON DELETE SET NULL
);



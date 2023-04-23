DROP DATABASE IF EXISTS fswd14_cr12_mount_everest_andrew_gorman;
CREATE DATABASE IF NOT EXISTS fswd14_cr12_mount_everest_andrew_gorman DEFAULT CHARSET UTF8;

CREATE TABLE `fswd14_cr12_mount_everest_andrew_gorman`.`locations`  (
`loc_id` INT(11) NOT  NULL AUTO_INCREMENT PRIMARY KEY,
`location_name` VARCHAR(255) NOT NULL ,
`price` DECIMAL(10,2) NOT NULL,
`description` VARCHAR(255) NOT NULL,
`activities` VARCHAR(255) DEFAULT 'Climbing and hiking',
`latitude` DECIMAL(8,6) NOT NULL,
`longitude` DECIMAL(9,6) NOT NULL,
`picture` VARCHAR(255) NULL,
`created_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

INSERT INTO locations (location_name, price, description, activities, latitude, longitude, picture)
VALUES ('Rax', 1000, "Mountains in the vicinity of Austria's capital city", 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', 47.701958, 15.740246, 'rax.jpeg');

INSERT INTO locations (location_name, price, description, activities, latitude, longitude, picture)
VALUES ('Ghandruk', 2000, 'A village development committee in the Kaski District of the Gandaki Province of Nepal in the Himalayas', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', 28.467074, 83.824528, 'ghandruk.jpeg');

INSERT INTO locations (location_name, price, description, activities, latitude, longitude, picture)
VALUES ('Skardu', 2500, 'Skardu is situated at an elevation of nearly 2,500 metres in the Skardu Valley, Pakistan in the Karakoram mountains', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', 35.325086, 75.551319, 'skardu.jpeg');

INSERT INTO locations (location_name, price, description, activities, latitude, longitude, picture)
VALUES ('Pamir mountain', 3500, 'Central Asian mountain range in a highland region, falling mostly within Tajikistan.', 'Hiking, canyoning, rock-climbing fishing, cold-water swimming', 39.001599, 72.000085, 'pamir.jpg');


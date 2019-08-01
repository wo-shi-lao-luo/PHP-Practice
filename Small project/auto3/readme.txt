Code is tested on XAMPP


Database config:

CREATE DATABASE misc;

GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';

CREATE TABLE autos (
   auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
   model VARCHAR(255),
   make VARCHAR(128),
   year INTEGER,
   mileage INTEGER,
   PRIMARY KEY (auto_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
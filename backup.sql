CREATE database webapp;
CREATE user webappadmin;
SET PASSWORD FOR 'webappadmin'@'%' = PASSWORD('webapppa$$');
GRANT ALL PRIVILEGES ON webapp.* TO 'webappadmin'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
USE webapp;
CREATE TABLE users
(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
email VARCCHAR(255),
age INT,
pseudo VARCHAR(255),
password VARCHAR(255),
statut VARCHAR(255),
description TEXT,
);

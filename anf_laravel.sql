/*
MySQL Backup
Database: anf_laravel
Backup Time: 2023-05-29 12:25:41
*/

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `anf_laravel`.`person`;
CREATE TABLE `person` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `age` int NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
BEGIN;
LOCK TABLES `anf_laravel`.`person` WRITE;
DELETE FROM `anf_laravel`.`person`;
INSERT INTO `anf_laravel`.`person` (`id`,`first_name`,`last_name`,`sex`,`age`,`email`) VALUES (48, 'Carlos Rafael', 'Lopez', 'Masculino', 40, 'charlietyn@gmail.com'),(51, 'Ariel', 'Hernandez', 'Masculino', 59, 'ahcege1963@gmail.com'),(46, 'Thalia', 'Blanco', 'Femenino', 22, 'tblanco@gmail.com'),(33, 'Amanda', 'Hdez', 'Femenino', 23, 'ahc13200@gmail.com'),(27, 'Arianna', 'Hdez', 'Femenino', 32, 'ariHdez@gmal.com')
;
UNLOCK TABLES;
COMMIT;

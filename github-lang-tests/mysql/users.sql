ALTER USER 'user_name'@'localhost' IDENTIFIED BY 'nowe_haslo';
CREATE USER 'user_name'@'localhost' IDENTIFIED BY 'nowe_haslo';
DROP USER 'nazwa_uzytkownika'@'localhost';
FLUSH PRIVILEGES;

UPDATE mysql.user SET Host='%' WHERE User='nazwa_uzytkownika';
SELECT user FROM mysql.user;

UPDATE mysql.user SET authentication_string=PASSWORD('password') WHERE User='user';

GRANT ALL PRIVILEGES ON baza_danych.* TO 'user'@'%';
GRANT ALL PRIVILEGES ON baza_danych.* TO 'nazwa_uzytkownika'@'localhost';

RENAME USER 'old_user_name'@'localhost' TO 'new_user_name'@'localhost';




CREATE USER 'default_user'@'%' IDENTIFIED BY 'unacontrasenyamuyperoquemuylarga';
GRANT ALL PRIVILEGES ON `zeus_airsoft`.* TO 'default_user'@'%';

CREATE USER 'default_user'@'localhost' IDENTIFIED BY 'unacontrasenyamuyperoquemuylarga';
GRANT ALL PRIVILEGES ON `zeus_airsoft`.* TO 'default_user'@'localhost';
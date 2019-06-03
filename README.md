##### Requirements #####
Apache server
  - AllowOverride All (to allow configuation using .htaccess)

MySQL:
  - host: localhost
  - username: luis_dias
  - password: XPk4hWPeTVdtKwEU
  - database name: php_test
  
##### Instalation #####
  1. Copy all content, except the folder "_sql/", into the Apache Server
  2. Import the file "_sql/template.sql" into the MySQL server
    - This file will create the user and database above
    - If using a different configuration for the database, update files "lib/config.php" and "api/config/database.php"

##### Use #####
  1. The app is ready to be used

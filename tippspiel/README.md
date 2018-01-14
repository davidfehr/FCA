FC Aich Tippspiel
===============

SETUP
================
Use Vagrant or similar
curl -s http://getcomposer.org/installer | php
php composer.phar install

Apache-Config

<VirtualHost *:80>
    ServerName tippspiel.local

    DocumentRoot "/var/www/tippspiel/web"
    DirectoryIndex frontend_dev.php

    <Directory "/var/www/tippspiel/web">
        Options FollowSymLinks ExecCGI
        AllowOverride All

        Order Allow,Deny
        Allow from All

        RewriteEngine On

        # we check if the .html version is here (caching)
        RewriteRule ^$ index.html [QSA]
        RewriteRule ^([^.]+)$ $1.html [QSA]
        RewriteCond %{REQUEST_FILENAME} !-f

        # no, so redirect to our front web controller
        RewriteRule ^(.*)$ frontend_dev.php [QSA,L]
    </Directory>


    # symfony alias
    Alias /sf /var/www/tippspiel/web/../lib/vendor/symfony/data/web/sf
    <Directory "/var/www/tippspiel/web/../lib/vendor/symfony/data/web/sf">
        AllowOverride All
        Allow from All
    </Directory>

    LogLevel info
    ErrorLog /var/log/apache2/tippspiel-error.log
</VirtualHost>

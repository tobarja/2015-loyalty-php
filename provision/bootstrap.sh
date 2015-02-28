#!/bin/bash
apt-get update

apt-get install -y mysql-client

echo mysql-server mysql-server/root_password select vagrant | debconf-set-selections
echo mysql-server mysql-server/root_password_again select vagrant | debconf-set-selections

apt-get install -y apache2 mysql-server libapache2-mod-php5 php5-mysql

/etc/init.d/apache2 restart

[ -f /usr/local/bin/composer ] || (curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer)

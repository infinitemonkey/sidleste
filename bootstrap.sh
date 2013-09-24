#!/usr/bin/env bash

apt-get update
apt-get install -y apache2-mpm-prefork php5 php5-curl php5-dev php5-gd php5-idn php5-imagick php5-imap php5-mysql php5-sqlite php5-xcache php5-mcrypt php5-xsl a2enmod suexec rewrite ssl actions include vhost_alias php-pear
pear install Mail-1.2.0
pear install Net_SMTP
rm -rf /var/www
ln -fs /vagrant /var/www

ln -sf /usr/share/zoneinfo/Europe/Zurich /etc/localtime
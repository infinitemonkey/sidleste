#!/usr/bin/env bash

apt-get update
apt-get install -y apache2-mpm-prefork php5 php5-curl php5-dev php5-gd php5-idn php5-imagick php5-imap php5-mysql php5-sqlite php5-xcache php5-mcrypt php5-xsl
a2enmod suexec rewrite ssl actions include vhost_alias
rm -rf /var/www
ln -fs /vagrant /var/www
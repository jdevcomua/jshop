#!/bin/sh

cd /home/freemark/sdelivery.dn.ua
git pull origin master
/usr/local/php71/bin/php ~/composer install
/usr/local/php71/bin/php yii migrate
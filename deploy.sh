#!/bin/sh

cd /home/freemark/sdelivery.dn.ua
git pull origin master
php ~/composer install
php yii migrate
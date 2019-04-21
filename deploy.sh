#!/bin/sh

git pull origin master
php ~/composer install
php yii migrate
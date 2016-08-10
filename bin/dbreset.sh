#!/bin/bash
php bin/console doctrine:schema:drop --force
sudo rm -rf var/
php bin/console doctrine:schema:create
echo 'y' | php bin/console doctrine:fixtures:load


#!/usr/bin/env bash

echo "Copying local wp-config.php";
cp config/wordpress/wp-config.php.local ./wp-config.php

echo "Copying plugins";
#cp -r config/wordpress/plugins/* ./wp-content/plugins/
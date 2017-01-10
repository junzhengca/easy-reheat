#!/bin/bash
source /etc/apache2/envvars
exec systemctl start apache2

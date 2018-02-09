#!/bin/sh
#######################################################
#
# This script compiles any found php files, checking
# for syntax errors.
#
#######################################################
BINDIR=/usr/local/php-5.3.5/sapi/cli
#BINDIR=/usr/local/php-5.6.30/sapi/cli
$BINDIR/php -v
find . -type f -name "*.php" ! -path "./releases/*" -exec $BINDIR/php -lf "{}" \;

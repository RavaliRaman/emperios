#!/bin/sh
######################################################################
#
#	This script generates a .pot file for translation using the
#	WordPress tools. Then, it calls some Connect Daily code to
#	use Connect Daily's existing translations and put what we
#	already have into the individual translation (.po) files.
#
#	Finally, it calls msgfmt to convert the .po files to .mo files.
#
#	See Also: README
#
######################################################################
rm *.po *.mo *.pot
WPDIR=/home/gsexton/public_html
CDAILYDIR=/home/gsexton/cdaily
LIBDIR=$CDAILYDIR/AddlJars
CAPTIONDIR=$CDAILYDIR/WEB-INF/classes
POTFILE=`pwd`/connect-daily-web-calendar.pot
#
#	Generate the POT file.
#
php $WPDIR/tools/i18n/makepot.php wp-plugin .. $POTFILE
#
#	create the PO files using our existing caption bundles.
#
java -classpath $LIBDIR/MHS.jar:$LIBDIR/htmlparser.jar:$LIBDIR/cdaily.jar \
	com.mhsoftware.cdaily.support.i18n.WordPressConverter \
	--potfile=$POTFILE \
	--ConnectDailyDirectory=$CAPTIONDIR
#
#	Generate the .MO files.
#
for file in *.po ; do msgfmt -o ${file/.po/.mo} $file ; done

<?php 

	// mySQL connection information
	$MYSQL_HOST = 'localhost';
	$MYSQL_USER = 'giftnzco_toshi';
	$MYSQL_PASSWORD = 'mysqladmin';
	$MYSQL_DATABASE = 'giftnzco_simn';
	$MYSQL_PREFIX = '';

	// main nucleus directory
	$DIR_NUCLEUS = '/home/giftnzco/public_html/simonmcdowell/gallery/nucleus/';

	// path to media dir
	$DIR_MEDIA = '/home/giftnzco/public_html/simonmcdowell/gallery/media/';

	// extra skin files for imported skins
	$DIR_SKINS = '/home/giftnzco/public_html/simonmcdowell/gallery/skins/';

	// these dirs are normally sub dirs of the nucleus dir, but 
	// you can redefine them if you wish
	$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
	$DIR_LANG = $DIR_NUCLEUS . 'language/';
	$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

	// include libs
	include($DIR_LIBS.'globalfunctions.php');
?>
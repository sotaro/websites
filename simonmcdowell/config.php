<?php

// script to create simon.conf
// run this like "php config.php > ./simon.conf".

$___config=array(
	'db'=> 
		array('host'=>'localhost',
			  'name'=>'giftnzco_simn',
			  'user'=>'giftnzco_toshi',
			  'pass'=>'mysqladmin')
);

echo serialize($___config);

?>

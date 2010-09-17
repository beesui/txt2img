<?php
/**
 * txt2img
 * Copyright (C) 2010, Marcel Hauri
 * http://blog.m83.ch/ - hello@m83.ch
 * 
 * Licensed under the new BSD License
 * See the License file for details
 * 
 * Version: 0.9.0 
 */

// init
$sDir = dirname(__FILE__).'/';

unset($CONF);
$CONF['HTDOCS_PATH'] = $sDir;

if (file_exists(realpath($CONF['HTDOCS_PATH'].'conf/config.php'))) {
  include_once(realpath($CONF['HTDOCS_PATH'].'conf/config.php'));
  include_once(realpath($CONF['HTDOCS_PATH'].'inc/class.txt2img.inc.php'));
  // Load Class txt2img
  $t2i = new txt2img($CONF);
} else {
	print 'Configuration file not found!';
}

if($CONF['GENERATOR_FORM']) {
  if(file_exists($CONF['GENERATOR_TEMPLATE'])) {
    include_once($CONF['GENERATOR_TEMPLATE']);	
  }
} else {
	print 'not allowed';
}

?>

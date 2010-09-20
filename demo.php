<?php

$sDir = dirname(__FILE__).'/';
$CONF['HTDOCS_PATH'] = $sDir;

if (file_exists(realpath($CONF['HTDOCS_PATH'].'conf/config.php'))) {
  include_once(realpath($CONF['HTDOCS_PATH'].'conf/config.php'));
  include_once(realpath($CONF['HTDOCS_PATH'].'inc/class.txt2img.inc.php'));
  // Load Class txt2img
  $t2i = new txt2img($CONF);
} else {
  die('Class txt2img not found!');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>txt2img Demonstration</title> 
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" /> 
<style type="text/css">
img {border: 0; padding: 0px;}
</style>
</head> 
<body> 
<h1><?php print $t2i->getImageHTML($t2i->getImage('Hallo und Willkommen', '48', '0099cc')); ?></h1>

<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

<h2><?php print $t2i->getImageHTML($t2i->getImage('Das ist ein Subtitel', '40', '0099cc')); ?></h2>

</p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p>

<h2><?php print $t2i->getImageHTML($t2i->getImage('Und noch ein Subtitel', '40', '0099cc')); ?></h2>
</p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p>
<?php print $t2i->getImageHTML($t2i->getImage('Mein Name ist Georgia, und ich sehe etwas anders aus!', '18', '0099cc', NULL, 'georgia.ttf')); ?>
</body>
</html>

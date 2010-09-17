<?php 
// Check Access
if(!isset($CONF['GENERATOR_FORM']) OR $CONF['GENERATOR_FORM'] === false) { die('not allowed'); } 

if(isset($_POST['text']) AND !empty($_POST['text'])) {
  $aImage  = $t2i->getImage(stripslashes($_POST['text']), stripslashes($_POST['size']), stripslashes($_POST['font_color']),  stripslashes($_POST['bg_color']),  stripslashes($_POST['font']));
  $sOutput = $t2i->getImageHTML($aImage);
}
$sText       = ($_POST['text'] ? $_POST['text'] : '');
$sSize       = ($_POST['size'] ? $_POST['size'] : $CONF['DEFAULT_FONT_SIZE']);
$sFontColor  = ($_POST['font_color'] ? $_POST['font_color'] : $CONF['DEFAULT_FONT_COLOR']);
$sBGColor    = ($_POST['bg_color'] ? $_POST['bg_color'] : $CONF['DEFAULT_BACKGROUND_COLOR']);
$sFont       = ($_POST['font'] ? $_POST['font'] : $CONF['DEFAULT_FONT']);
$sOutput     = ($sOutput ? $sOutput : 'No Output generated!');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">  
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>txt2img Generator Form</title>
<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="./css/colorpicker.css" type="text/css" /> 
<script type="text/javascript" src="./js/jquery.js"></script> 
<script type="text/javascript" src="./js/colorpicker.js"></script> 
<script type="text/javascript" src="./js/eye.js"></script> 
<script type="text/javascript" src="./js/utils.js"></script> 
<script type="text/javascript" src="./js/layout.js?ver=1.0.2"></script> 
</head>
<body>
 <h1>txt2img Generator Form</h1>
 <p>This Form helps yout to Create Images from Text</p>
 <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
 <table border="0" summary="txt2img Form">
  <tr>
   <td colspan="2">
    <input type="text" name="text" value="<?php print stripslashes($sText); ?>" maxlength="60" class="longtext"/><br />
   </td>
  </tr>
  <tr>
   <td class="txt">Text Color:</td> 
   <td>
    #<input type="text" maxlength="6" size="6" name="font_color" id="colorpicker_txt" value="<?php print $sFontColor; ?>" /><br />
   </td>
  </tr>
  <tr>
   <td class="txt">Background Color:</td>
   <td>
    #<input type="text" maxlength="6" size="6" name="bg_color" id="colorpicker_bg" value="<?php print $sBGColor; ?>" /><br />
   </td>
  </tr>
  <tr>
   <td class="txt">Font-Size:</td>
   <td> <select name="size">
         <?php print $t2i->getFontSizes($sSize); ?>
        </select>
   </td>
  </tr>
  <tr>
   <td class="txt">Font:</td>
   <td> <select name="font">
         <?php print $t2i->getAviableFonts($sFont); ?>
        </select>
   </td>
  </tr>
  <tr>
   <td colspan="2">  
    <input type="submit" name="submit" value="Generate" class="submit" />
   </td>
  </td>
 </table>
 </form>
 <br /><br />
 <h2>Output</h2>
 <div class="output">
  <?php $t2i->getAviableFonts(); ?>
  <?php print $sOutput; ?>
 </div>
</body>
</html>

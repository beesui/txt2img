<?php
/**
 * txt2img
 * Copyright (C) 2010, Marcel Hauri
 * http://blog.m83.ch/ - hello@m83.ch
 * 
 * Licensed under the new BSD License
 * See the License file for details
 * 
 * Version: 0.9.3 
 */


// Systempath to the Generated Folder
$CONF['GENERATED_PATH'] = realpath($CONF['HTDOCS_PATH'].'/generated');

// URI Path to the Generated Folder BSP: projects.m83.ch/(txt2img/generated)
$CONF['HTML_PATH'] = '/generated';


// Path to the Fonts folder 
$CONF['FONTS_PATH'] = realpath($CONF['HTDOCS_PATH'].'/fonts');

// Path to Generator Form Template
$CONF['GENERATOR_TEMPLATE'] = realpath($CONF['HTDOCS_PATH'].'/form.tpl.php');

// Enable Generator Form
$CONF['GENERATOR_FORM'] = true;

// Default Font
$CONF['DEFAULT_FONT'] = 'ASENINE_.ttf';

// Default Font Color
$CONF['DEFAULT_FONT_COLOR'] = '000000';

// Default font Background Color
$CONF['DEFAULT_BACKGROUND_COLOR'] = 'ffffff';

// Default Font Size
$CONF['DEFAULT_FONT_SIZE'] = '11';


// User Generatet SALT
$CONF['SALT'] = 'OlRqw6tAq83Oa9ZtU3';

?>

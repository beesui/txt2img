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

class txt2img {
	
  protected $conf;
  protected $font_color;
  protected $font_size;
  protected $bg_color;
  protected $cache;
  protected $salt;
  protected $text;
  protected $font;
  protected $htmlpath;
  protected $fontspath;
  
  public function __construct($aConf = NULL) {
    $this->cache_name = NULL;
    $this->conf       = $aConf;
    $this->text       = 'No Text given!';
    $this->cache      = $this->conf['GENERATED_PATH'];
    $this->salt       = $this->conf['SALT'];	
    $this->font       = $this->conf['DEFAULT_FONT'];
    $this->fontspath  = $this->conf['FONTS_PATH'];
    $this->font_color = $this->conf['DEFAULT_FONT_COLOR'];
    $this->bg_color   = $this->conf['DEFAULT_BACKGROUND_COLOR'];
    $this->font_size  = $this->conf['DEFAULT_FONT_SIZE'];
    $this->htmlpath   = $this->conf['HTML_PATH']; 
    
    // Check for GD Support
    $this->checkGdSupport();
  }
  
  /**
   * Function to Check GD and FreeType Support
   */
  private function checkGdSupport() {
    if (!function_exists('gd_info')) {
      die ('No GD Support in PHP.');
    } else {
      $aGD = gd_info();
      if($aGD['FreeType Support'] === false) {
        die ('No FreeType Support in GD');
      }
    }
  }
  /**
  * Returns a Image Array
  */
  public function getImage($sText = NULL, $sSize = NULL, $sColor = NULL, $sBackground = NULL, $sFont = NULL) {
    $this->text       = ($sText ? $sText : $this->text);
    $this->font_color = ($sColor ? $sColor : $this->font_color);
    $this->bg_color   = ($sBackground ? $sBackground : $this->bg_color);
    $this->font_size  = ($sSize ? $sSize : $this->font_size);
    $this->font       = ($sFont ? $sFont : $this->font);

    $aValue = array('text'       => $this->text, 
                    'size'       => $this->font_size, 
                    'font_color' => $this->font_color, 
                    'bg_color'   => $this->bg_color,
                    'font'       => $this->font);

    $this->cache_name = $this->genCacheName($aValue);
    if(file_exists($this->cache.'/'.$this->cache_name)) {
      $aImageSize = getimagesize($this->cache.'/'.$this->cache_name);
      return array('name'   => $this->cache_name, 
                   'alt'    => htmlspecialchars($this->text), 
                   'width'  => $aImageSize[0],
                   'height' => $aImageSize[1],
                   'path'   => $this->htmlpath);
    } else {
      return $this->genImage($aValue, $this->cache_name);	
    }
  }

  /**
  * Generate a uniqe File Name
  */
  private function genCacheName($aValue) {
    $sCache = sha1($aValue['text'].':'
                  .$aValue['size'].':'
                  .$aValue['font_color'].':'
                  .$aValue['bg_color'].':'
                  .$aValue['font'].':'
                  .$this->salt);
    return $sCache.'.png';
  }

  /**
  * Generate the Image from Text
  */  
  private function genImage($aValue = NULL, $sCacheName) {
    $this->font_color = $this->html2rgb($aValue['font_color']);
    $this->bg_color   = $this->html2rgb($aValue['bg_color']);
    $this->cache_name = $sCacheName;
    $this->font       = $this->fontspath.'/'.$aValue['font'];
    $aTTF   = imagettfbbox($aValue['size'], 0, $this->font, $aValue['text']);
    $sSizeW = abs($aTTF[2] - $aTTF[0]); 
    $sSizeH = abs($aTTF[7] - $aTTF[1]);
    $sX     = -abs($aTTF[0]);
    $sY     = $sSizeH - abs($aTTF[1]);
    $oImage = imagecreatetruecolor($sSizeW + 2, $sSizeH + 2);
    $oBG    = imagecolorallocate($oImage, $this->bg_color[0], $this->bg_color[1], $this->bg_color[2]);
    $oFG    = imagecolorallocate($oImage, $this->font_color[0], $this->font_color[1], $this->font_color[2]);
    imagefilledrectangle($oImage, 0, 0, $sSizeW + 2, $sSizeH + 4, $oBG);
    imagettftext($oImage, $aValue['size'], 0, $sX+2, $sY+2, $oFG, $this->font, $aValue['text']);
    imagepng($oImage, $this->cache.'/'.$this->cache_name);
    imagedestroy($oImage);
    
    return array('name'   => $this->cache_name, 
                 'alt'    => htmlspecialchars($aValue['text']), 
                 'width'  => $sSizeW, 
                 'height' => $sSizeH+2,
                 'path'   => $this->htmlpath);
  }

  /**
  * Convert HexColor in RGB Color
  */
  private function html2rgb($sColor = NULL) {
    if ($sColor[0] == '#') {$sColor = substr($sColor, 1); }
    if (strlen($sColor) == 6) {
      list($r, $g, $b) = array($sColor[0].$sColor[1],
                               $sColor[2].$sColor[3],
                               $sColor[4].$sColor[5]);
    } else if(strlen($sColor) == 3) {
      list($r, $g, $b) = array($sColor[0].$sColor[0], $sColor[1].$sColor[1], $sColor[2].$sColor[2]);
    } else {
      return false;
    }

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    return array($r, $g, $b);
  } 
  
  /**
  * Returns a Option List with aviable Font Sizes
  *
  */
  public function getFontSizes($sValue = NULL) {
    $sSize = 18;
    for($x=0;$x<=10;$x++) { 
      if($sSize <= '11') {$sSize++;} 
      else {$sSize = $sSize + 2; }
      if($sValue == $sSize) {$selected = 'selected';} else {$selected = '';}
      $sHTML .= '<option value="'.$sSize.'" '.$selected.'>'.$sSize.'</option>';
    }
    return $sHTML;
  }

  public function getAviableFonts($sValue = NULL) {
    foreach(glob($this->fontspath.'/*.ttf') as $sFont) {
      $sFontName = str_replace($this->fontspath.'/', '', $sFont);
      if($sFontName === $sValue) {$selected = 'selected';} else {$selected = '';}
      $sHTML .= '<option value="'.$sFontName.'" '.$selected.'>'.$sFontName.'</option>';
    }
    return $sHTML;
  }
  
  /**
  * Transform the Image Array in to HTML
  */
  public function getImageHTML($aValue = NULL) {
   return '<img src="'.$aValue['path'].'/'.$aValue['name'].'" alt="'.$aValue['alt'].'" title="'.$aValue['alt'].'" width="'.$aValue['width'].'" height="'.$aValue['height'].'" />';
  }
}
?>

<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 携帯用標準ビュー
 *
 * @package     sfJpMobileView
 * @subpackage  view
 * @version     $Id$
 */
class sfJpMobileView extends sfPHPView
{
  protected function renderFile($_sfFile)
  {
    $info = pathinfo($_sfFile);
    $base = "{$info['dirname']}/{$info['filename']}";
    $filename = $base . ucfirst(strtolower(sfJpMobile::getCarrierName())) . '.' . $info['extension'];
    if (!is_readable($filename)) {
      $filename = "{$base}Mobile.{$info['extension']}";
      if (!sfJpMobile::isMobile() || !is_readable($filename)) {
        $filename = $_sfFile;
      }
    }
    return parent::renderFile($filename);
  }

}
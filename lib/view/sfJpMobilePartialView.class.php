<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 携帯用パーシャルビュー
 *
 * @package     sfJpMobileView
 * @subpackage  view
 * @version     $Id: 5bbff10933284560e81f720f8647e68ad4033288 $
 */
class sfJpMobilePartialView extends sfPartialView
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
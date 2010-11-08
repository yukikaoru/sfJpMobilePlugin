<?php
/* vim:set et ts=4 sts=4 sw=4: */
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
        $filename = $base . ucfirst(strtolower(sfJpMobile::getInstance()->getCarrierName())) . '.' . $info['extension'];
        if (!is_readable($filename)) {
            $filename = "{$base}Mobile.{$info['extension']}";
            if (!sfJpMobile::getInstance()->isMobile() || !is_readable($filename)) {
                $filename = $_sfFile;
            }
        }
        return parent::renderFile($filename);
    }
}
<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * その他端末オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id$
 */
class sfJpMobileDeviceOther extends sfJpMobileDevice
{
    public function parse()
    {
        $this->id = "other";
    }
}

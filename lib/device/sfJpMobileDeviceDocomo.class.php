<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * docomo用端末オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id:$
 */
class sfJpMobileDeviceDocomo extends sfJpMobileDevice
{
    public function parse()
    {
        if ($ua = getenv('HTTP_USER_AGENT')) {
            if (preg_match('#^DoCoMo/[12]\.0[/\s]([^/(]+)#', $ua, $matches)) {
                $this->id = $matches[1];
                return null;
            }
        }
    }
}

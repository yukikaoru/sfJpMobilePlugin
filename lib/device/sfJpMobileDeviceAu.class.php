<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * au用端末オブジェクト
 *
 * @package     sfJpMobilePlugin
 * @subpackage  device
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id$
 */
class sfJpMobileDeviceAu extends sfJpMobileDevice
{
    public function parse()
    {
        if ($ua = getenv('HTTP_USER_AGENT')) {
            if (preg_match('/^.+?-([^\s]+)/', $ua, $matches)) {
                $this->id = $matches[1];
            }
            return null;
        }
    }
}

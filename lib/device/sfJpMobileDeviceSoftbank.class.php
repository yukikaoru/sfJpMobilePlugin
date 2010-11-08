<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * SoftBank用端末オブジェクト
 *
 * @package     sfJpMobilePlugin
 * @subpackage  device
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id$
 */
class sfJpMobileDeviceSoftbank extends sfJpMobileDevice
{
    public function parse()
    {
        if ($ua = getenv('HTTP_USER_AGENT')) {
            if (preg_match('!^MOT-([^/]+)!', $ua, $matches)) {
                $this->id = $matches[1];
            } else if (preg_match('!^.+?/.+?/([^/]+)!', $ua, $matches)) {
                $this->id = $matches[1];
            }
            return null;
        }
    }
}

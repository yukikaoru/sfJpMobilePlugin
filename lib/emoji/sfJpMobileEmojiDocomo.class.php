<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * docomo絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id$
 */
class sfJpMobileEmojiDocomo extends sfJpMobileEmoji
{
    public function initialize()
    {
        $this->_binCodeRegex = '/\xEE(?:'
                             . '\x98[\xBE-\xBF]'
                             . '|\x99[\x80-\xBF]'
                             . '|\x9A[\x80-\xBA]'
                             . '|\x9B[\x8E-\xBF]'
                             . '|\x9C[\x80-\xBF]'
                             . '|\x9D[\x80-\x97]'
                             . ')/';
    }
    public function convert($str)
    {
        return $str;
    }
}

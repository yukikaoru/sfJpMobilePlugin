<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * PC用絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id$
 */
class sfJpMobileEmojiOther extends sfJpMobileEmoji
{
    public function convert($str)
    {
        return $str;
    }
    public function findBin($str)
    {
        $result = array();
        return $result;
    }
}

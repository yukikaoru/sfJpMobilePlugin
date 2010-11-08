<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * au絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id$
 */
class sfJpMobileEmojiAu extends sfJpMobileEmoji
{
    protected $_binCodeRegex = '/\xEE(?:\x88[\xB4-\xBF]|\x8D[\x80-\x82]|\x91[\xA8-\xBF]|\x97[\x80-\x9F]|[\x89-\x8C\x92-\x96][\x80-\xBF])/';
}

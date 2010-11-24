<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * SoftBank絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id$
 */
class sfJpMobileEmojiSoftbank extends sfJpMobileEmoji
{
    protected $_binCodeRegex = '/\xEE[\x80\x81\x84\x85\x88\x89\x8C\x8D\x90\x91\x94][\x80-\xBF]/';
}

<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * SoftBank絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id: cc34213571e627a190f4758e2ab03b0574131ba0 $
 */
class sfJpMobileEmojiSoftbank extends sfJpMobileEmoji
{
  protected $_binCodeRegex = '/\xEE[\x80\x81\x84\x85\x88\x89\x8C\x8D\x90\x91\x94][\x80-\xBF]/';
}

<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * KDDI絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id: 2bb0147bc2c5d74e3fa9a042ae2cde838ee9c8f3 $
 */
class sfJpMobileEmojiKddi extends sfJpMobileEmoji
{
  protected $_binCodeRegex = '/\xEE(?:\x88[\xB4-\xBF]|\x8D[\x80-\x82]|\x91[\xA8-\xBF]|\x97[\x80-\x9F]|[\x89-\x8C\x92-\x96][\x80-\xBF])/';
}

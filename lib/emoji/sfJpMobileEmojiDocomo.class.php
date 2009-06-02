<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * DoCoMo絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id: 4abd1936fb25c82d327150c8a509d6aa86fe9bd9 $
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

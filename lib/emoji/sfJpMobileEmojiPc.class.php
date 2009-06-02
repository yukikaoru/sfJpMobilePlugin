<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * PC用絵文字オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id: 5d337a9f05d194c88d800baa2a5d76448fb0fcd4 $
 */
class sfJpMobileEmojiPc extends sfJpMobileEmoji
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

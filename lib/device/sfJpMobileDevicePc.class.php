<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * PC用端末オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @version     $Id$
 */
class sfJpMobileDevicePc extends sfJpMobileDevice
{
  protected $_emojiClass = 'sfJpMobileEmojiPc';
  protected function _initialize()
  {
    $uid = getenv('REMOTE_ADDR');
  }
  public function parse()
  {
    $this->_deviceId = "PC";
  }

}

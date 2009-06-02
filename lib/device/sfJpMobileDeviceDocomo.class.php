<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * DoCoMo用端末オブジェクト
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @version     $Id$
 */
class sfJpMobileDeviceDocomo extends sfJpMobileDevice
{
  protected $_emojiClass = 'sfJpMobileEmojiDocomo';
  protected function _initialize()
  {
    if ($uid = getenv('HTTP_X_DCMGUID')) {
      $this->_uid = $uid;
    } else if (array_key_exists('uid', $_GET) && $_GET['uid'] != 'NULLGWDOCOMO') {
      $this->_uid = $_GET['uid'];
    } else if (array_key_exists('uid', $_POST) && $_POST['uid'] != 'NULLGWDOCOMO') {
      $this->_uid = $_POST['uid'];
    }
  }
  public function parse()
  {
    if ($ua = getenv('HTTP_USER_AGENT')) {
      if (preg_match('#^DoCoMo/[12]\.0[/\s]([^/(]+)#', $ua, $matches)) {
        $this->_deviceId = $matches[1];
        return null;
      }
    }
    throw new sfMobileNotDetermineException('May be access from PC browser');
  }

}

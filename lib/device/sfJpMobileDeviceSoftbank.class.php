<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * SoftBank用端末オブジェクト
 *
 * @package     sfJpMobilePlugin
 * @subpackage  device
 * @version     $Id: e5d7ce4a97e9c6bbc88e82dcf199c81f3bec26cb $
 */
class sfJpMobileDeviceSoftbank extends sfJpMobileDevice
{
  protected $_emojiClass = 'sfJpMobileEmojiSoftbank';
  protected function _initialize()
  {
    if ($this->_uid = getenv('HTTP_X_JPHONE_UID')) {
      $this->_uid = substr($this->_uid, 2);
    };
  }
  public function parse()
  {
    if ($ua = getenv('HTTP_USER_AGENT')) {
      if (preg_match('!^MOT-([^/]+)!', $ua, $matches)) {
        $this->_deviceId = $matches[1];
      } else if (preg_match('!^.+?/.+?/([^/]+)!', $ua, $matches)) {
        $this->_deviceId = $matches[1];
      }
      return null;
    }
    throw new sfMobileNotDetermineException('May be access from PC browser');
  }

}

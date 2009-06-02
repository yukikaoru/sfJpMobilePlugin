<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * KDDI用端末オブジェクト
 *
 * @package     sfJpMobilePlugin
 * @subpackage  device
 * @version     $Id: 3ec9d2ff32ea2e10093131dca1f29b940f2ef230 $
 */
class sfJpMobileDeviceKddi extends sfJpMobileDevice
{
  protected $_emojiClass = 'sfJpMobileEmojiKddi';
  protected function _initialize()
  {
    $this->_uid = getenv('HTTP_X_UP_SUBNO');
  }
  public function parse()
  {
    if ($ua = getenv('HTTP_USER_AGENT')) {
      if (preg_match('/^.+?-([^\s]+)/', $ua, $matches)) {
        $this->_deviceId = $matches[1];
      }
      return null;
    }
    throw new sfMobileNotDetermineException('May be access from PC browser');
  }

}

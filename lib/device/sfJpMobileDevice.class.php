<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * sfDevice abstract class
 * キャリア毎の実装をする際には、このクラスを継承する
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @version     $Id: 54197c2f015b7e40ff9ef92466479819b5ef72af $
 */
abstract class sfJpMobileDevice
{
  /**
   * @var string uid
   */
  protected $_uid;
  /**
   * @var string model name
   */
  protected $_deviceId;
  /**
   * @var string emoji class name
   */
  protected $_emojiClass = null;
  /**
   * @var sfJpMobileEmoji
   */
  protected static $_emoji = null;
  /**
   * constructor
   */
  public function __construct()
  {
    $this->parse();
    $this->_initialize();
  }
  /**
   * initialize
   * @return null
   */
  protected function _initialize(){}
  /**
   * parse UserAgent
   * @throws  sfMobilenotDetermineException
   * @return  null
   */
  public abstract function parse();
  /**
   * set emoji object
   * @param   string  $class
   * @return  null
   */
  public function setEmojiClass($class)
  {
    $this->_emojiClass = $class;
  }
  /**
   * get UID
   * @return  string
   */
  public function getUid()
  {
    return $this->_uid;
  }
  /**
   * get device id
   * @return  string
   */
  public function getDeviceId()
  {
    return $this->_deviceId;
  }

  /**
   * get emoji obuject
   * @return sfJpMobileEmoji
   */
  public function getEmoji()
  {
    if (!(self::$_emoji instanceof $this->_emojiClass)) {
      self::$_emoji = new $this->_emojiClass();
    }
    return self::$_emoji;
  }

}

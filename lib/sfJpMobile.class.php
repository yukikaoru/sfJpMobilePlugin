<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * Net_UserAgent_Mobileでは少々腰が重たいので、Railsのjpmobile風な判別方法で
 *
 * @package     sfJpMobile
 * @subpackage  lib
 * @version     $Id$
 */
class sfJpMobile
{
  /**
   * @var sfDevice
   */
  private static $_device = null;
  /**
   * @var stdClass
   */
  private static $_carrier = null;
  /**
   * initialize
   * @return null
   */
  public static function initialize()
  {
    self::$_carrier = new stdClass();
  }
  /**
   * ドライバの生成
   * @return sfJpMobileDevice
   */
  public static function getDevice()
  {
    try {
      $term = '';
      switch (true) {
        case self::isDocomo():
          $term = 'Docomo';
          break;
        case self::isKddi():
          $term = 'Kddi';
          break;
        case self::isSoftbank():
          $term = 'Softbank';
          break;
        /*
        case self::isWillcom():
          $term = 'Willcom';
          break;
        */
        default:
          $term = 'Pc';
          break;
      }
      return self::_termFactory($term);
    } catch (sfMobileNotDetermineException $e) {
      return self::_termFactory('Pc');
    }
  }

  /**
   * Deviceクラスのファクトリメソッド
   * @param   string
   * @return  sfJpMobileDevice
   */
  private static function _termFactory($term)
  {
    $class = "sfJpMobileDevice{$term}";
    if (!(self::$_device instanceof sfDevice)) {
      self::$_device = new $class;
    }
    return self::$_device;
  }

  /**
   * UserAgentによるパターン検索
   * @param		array|string
   * @return 	boolean
   * @throws	sfMobileNotDetermineException
   */
  private static function _checkCarrier($patterns)
  {
    include sfContext::getInstance()->getConfigCache()->checkConfig('config/jpmobile/istyle.yml');
    if (!($ua = getenv('HTTP_USER_AGENT'))) {
      throw new sfMobileNotDetermineException('May be access from PC Browser.');
    }
    if (!is_array($patterns)) {
      $patterns = array($patterns);
    }
    foreach ($patterns as $pattern) {
      if (preg_match($pattern, $ua)) {
        return true;
      }
    }
    return false;
  }

  /**
   * 携帯かどうか
   * @return boolean
   */
  public static function isMobile()
  {
    return self::isDocomo() || self::isKddi() || self::isSoftbank() || self::isWillcom();
  }

  /**
   * DoCoMoかどうか
	 * @return boolean
   */
  public static function isDocomo()
  {
    if (!isset(self::$_carrier->docomo)) {
      self::$_carrier->docomo = self::_checkCarrier('/^DoCoMo/');
    }
    return self::$_carrier->docomo;
  }

  /**
   * KDDIかどうか
   * @return boolean
   */
  public static function isKddi()
  {
    if (!isset(self::$_carrier->kddi)) {
      $patterns = array(
        '/^KDDI-/',
        '/^UP\.Browser/',
      );
      self::$_carrier->kddi = self::_checkCarrier($patterns);
    }
    return self::$_carrier->kddi;
  }

  /**
   * SoftBankかどうか
   * @return boolean
   */
  public static function isSoftbank()
  {
    if (!isset(self::$_carrier->softbank)) {
      $patterns = array(
        '/^SoftBank/',
        '/^Semulator/',
        '/^Vodafone/',
        '/^Vemulator/',
        '/^MOT-/',
        '/^MOTEMULATOR/',
        '/^J-PHONE/',
        '/^J-EMULATOR/',
      );
      self::$_carrier->softbank = self::_checkCarrier($patterns);
    }
    return self::$_carrier->softbank;
  }

  /**
   * WILLCOMかどうか
   * @return boolean
   */
  public static function isWillcom()
  {
    if (!isset(self::$_carrier->willcom)) {
      self::$_carrier->willcom = self::_checkCarrier('#^Mozilla/3\.0\((?:DDIPOCKET|WILLCOM);#');
    }
    return self::$_carrier->willcom;
  }

  /**
   * キャリア名の取得
   * @return string
   */
  public static function getCarrierName()
  {
    if (self::isDocomo()) {
      return 'DoCoMo';
    } else if (self::isKddi()) {
      return 'KDDI';
    } else if (self::isSoftbank()) {
      return 'SoftBank';
    } else if (self::isWillcom()) {
      return 'willcom';
    }
    return 'PC';
  }

  /**
   * 短いキャリア名の取得
   * @return string
   */
  public static function getShortCarrierName()
  {
    if (self::isDocomo()) {
      return 'dc';
    } else if (self::isKddi()) {
      return 'au';
    } else if (self::isSoftbank()) {
      return 'sb';
    } else if (self::isWillcom()) {
      return 'wm';
    }
    return 'pc';
  }

  /**
   * 絵文字オブジェクトの取得
   * @return sfJpMobileEmoji
   */
  public static function getEmoji()
  {
    return self::getDevice()->getEmoji();
  }

}

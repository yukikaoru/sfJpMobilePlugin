<?php
/* vim:set expandtab tabstop=4 softtabstop=4 shiftwidth=4: */
/**
 * Net_UserAgent_Mobileでは少々腰が重たいので、Railsのjpmobile風な判別方法で
 *
 * @package     sfJpMobile
 * @subpackage  lib
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id$
 */
class sfJpMobile
{
    /**
     * @var sfJpMobile
     */
    private static $instance;
    /**
     * @var sfJpMobileDevice
     */
    private $device;
    /**
     * @var sfJpMobileEmoji
     */
    private $emoji;
    /**
     * @var stdClass
     */
    private $carrier;
    /**
     * @var string
     */
    private $uid;
    /**
     * constructor
     */
    private function __construct()
    {
        $this->carrier = new stdClass();
    }
    /**
     * singleton
     *
     * @return sfJpMobile
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * ドライバの生成
     * sf_jp_mobile.get_deviceイベントを通知
     *
     * @return sfJpMobileDevice
     */
    public function getDevice()
    {
        if (!($this->device instanceof sfJpMobileDevice)) {
            $device = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'sf_jp_mobile.get_device'))->getReturnValue();
            if (!($device instanceof sfJpMobileDevice)) {
                $class = "sfJpMobileDevice" . ucfirst(strtolower($this->getCarrierName()));
                $this->device = new $class();
            }
        }
        return $this->device;
    }
    /**
     * UserAgentによるパターン検索
     * @param		array|string
     * @return 	boolean
     * @throws	sfMobileNotDetermineException
     */
    private function _checkCarrier($patterns)
    {
        include sfContext::getInstance()->getConfigCache()->checkConfig('config/jpmobile/istyle.yml');
        if (!($ua = getenv('HTTP_USER_AGENT'))) {
            throw new sfMobileNotDetermineException('This access is not from mobile phone.');
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
    public function isMobile()
    {
        return $this->isDocomo() || $this->isAu() || $this->isSoftbank();
    }

    /**
     * docomoかどうか
     * @return boolean
     */
    public function isDocomo()
    {
        if (!isset($this->carrier->docomo)) {
            $this->carrier->docomo = $this->_checkCarrier('/^DoCoMo/');
        }
        return $this->carrier->docomo;
    }

    /**
     * KDDIかどうか
     * @return boolean
     */
    public function isAu()
    {
        if (!isset($this->carrier->au)) {
            $patterns = array(
                '/^KDDI-/',
                '/^UP\.Browser/',
            );
            $this->carrier->au = $this->_checkCarrier($patterns);
        }
        return $this->carrier->au;
    }

    /**
     * SoftBankかどうか
     * @return boolean
     */
    public function isSoftbank()
    {
        if (!isset($this->carrier->softbank)) {
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
            $this->carrier->softbank = $this->_checkCarrier($patterns);
        }
        return $this->carrier->softbank;
    }
    /**
     * キャリア名の取得
     * @return string
     */
    public function getCarrierName()
    {
        if ($this->isDocomo()) {
            return 'docomo';
        } else if ($this->isAu()) {
            return 'au';
        } else if ($this->isSoftbank()) {
            return 'SoftBank';
        }
        return 'other';
    }
    /**
     * UIDの取得
     *
     * @return string
     */
    public function getUid()
    {
        if ($this->isDocomo()) {
            $this->uid = getenv('HTTP_X_DCMGUID');
        } else if ($this->isAu()) {
            $this->uid = getenv('HTTP_X_UP_SUBNO');
        } else if ($this->isSoftbank()) {
            if ($this->uid = getenv('HTTP_X_JPHONE_UID')) {
                $this->uid = substr($this->uid, 1);
            }
        }
        return $this->uid;
    }
    /**
     * 絵文字オブジェクトの取得
     * @return sfJpMobileEmoji
     */
    public function getEmoji()
    {
        if (!($this->emoji instanceof sfJpMobileEmoji)) {
            $emoji = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'sf_jp_mobile.get_emoji'))->getReturnValue();
            if (!($emoji instanceof sfJpMobileEmoji)) {
                $class = "sfJpMobileEmoji" . ucfirst(strtolower($this->getCarrierName()));
                $this->emoji = new $class();
            }
        }
        return $this->emoji;
    }
}

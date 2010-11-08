<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * sfDevice abstract class
 * キャリア毎の実装をする際には、このクラスを継承する
 *
 * @property string $id
 * @property string $name
 * @property enum $carrier
 * @property boolean $supported
 * @property date $released_at
 * @property integer $wallpaper_width
 * @property integer $wallpaper_height
 * @property integer $browser_width
 * @property integer $browser_height
 * @property string $browser_version
 * @property boolean $gif
 * @property boolean $jpeg
 * @property boolean $png
 * @property boolean $bmp2
 * @property boolean $bmp4
 * @property boolean $mng
 * @property boolean $animation_gif
 * @property boolean $transparent_gif
 * @property boolean $amc
 * @property boolean $asf
 * @property boolean $3g2
 * @property boolean $3gp
 * @property integer $chord
 * @property boolean $music
 * @property boolean $full_music
 * @property boolean $movie
 * @property boolean $huge_movie
 * @property boolean $appli
 * @property enum $appli_type
 * @property string $appli_version
 * @property integer $appli_capacity
 * @property boolean $flash
 * @property string $flash_version
 * @property boolean $gps
 * @property boolean $dress_up
 * @property enum $ssl
 * @property boolean $cookie
 * @property boolean $utn
 *
 * @method string              getId()                       Returns the current record's "id" value
 * @method string              getName()                     Returns the current record's "name" value
 * @method enum                getCarrier()                  Returns the current record's "carrier" value
 * @method boolean             getSupported()                Returns the current record's "supported" value
 * @method date                getReleasedAt()               Returns the current record's "released_at" value
 * @method integer             getWallpaperWidth()           Returns the current record's "wallpaper_width" value
 * @method integer             getWallpaperHeight()          Returns the current record's "wallpaper_height" value
 * @method integer             getBrowserWidth()             Returns the current record's "browser_width" value
 * @method integer             getBrowserHeight()            Returns the current record's "browser_height" value
 * @method string              getBrowserVersion()           Returns the current record's "browser_version" value
 * @method boolean             getGif()                      Returns the current record's "gif" value
 * @method boolean             getJpeg()                     Returns the current record's "jpeg" value
 * @method boolean             getPng()                      Returns the current record's "png" value
 * @method boolean             getBmp2()                     Returns the current record's "bmp2" value
 * @method boolean             getBmp4()                     Returns the current record's "bmp4" value
 * @method boolean             getMng()                      Returns the current record's "mng" value
 * @method boolean             getAnimationGif()             Returns the current record's "animation_gif" value
 * @method boolean             getTransparentGif()           Returns the current record's "transparent_gif" value
 * @method boolean             getAmc()                      Returns the current record's "amc" value
 * @method boolean             getAsf()                      Returns the current record's "asf" value
 * @method boolean             get3g2()                      Returns the current record's "3g2" value
 * @method boolean             get3gp()                      Returns the current record's "3gp" value
 * @method integer             getChord()                    Returns the current record's "chord" value
 * @method boolean             getMusic()                    Returns the current record's "music" value
 * @method boolean             getFullMusic()                Returns the current record's "full_music" value
 * @method boolean             getMovie()                    Returns the current record's "movie" value
 * @method boolean             getHugeMovie()                Returns the current record's "huge_movie" value
 * @method boolean             getAppli()                    Returns the current record's "appli" value
 * @method enum                getAppliType()                Returns the current record's "appli_type" value
 * @method string              getAppliVersion()             Returns the current record's "appli_version" value
 * @method integer             getAppliCapacity()            Returns the current record's "appli_capacity" value
 * @method boolean             getFlash()                    Returns the current record's "flash" value
 * @method string              getFlashVersion()             Returns the current record's "flash_version" value
 * @method boolean             getGps()                      Returns the current record's "gps" value
 * @method boolean             getDressUp()                  Returns the current record's "dress_up" value
 * @method enum                getSsl()                      Returns the current record's "ssl" value
 * @method boolean             getCookie()                   Returns the current record's "cookie" value
 * @method boolean             getUtn()                      Returns the current record's "utn" value
 * @method Mobile              setId()                       Sets the current record's "id" value
 * @method Mobile              setName()                     Sets the current record's "name" value
 * @method Mobile              setCarrier()                  Sets the current record's "carrier" value
 * @method Mobile              setSupported()                Sets the current record's "supported" value
 * @method Mobile              setReleasedAt()               Sets the current record's "released_at" value
 * @method Mobile              setWallpaperWidth()           Sets the current record's "wallpaper_width" value
 * @method Mobile              setWallpaperHeight()          Sets the current record's "wallpaper_height" value
 * @method Mobile              setBrowserWidth()             Sets the current record's "browser_width" value
 * @method Mobile              setBrowserHeight()            Sets the current record's "browser_height" value
 * @method Mobile              setBrowserVersion()           Sets the current record's "browser_version" value
 * @method Mobile              setGif()                      Sets the current record's "gif" value
 * @method Mobile              setJpeg()                     Sets the current record's "jpeg" value
 * @method Mobile              setPng()                      Sets the current record's "png" value
 * @method Mobile              setBmp2()                     Sets the current record's "bmp2" value
 * @method Mobile              setBmp4()                     Sets the current record's "bmp4" value
 * @method Mobile              setMng()                      Sets the current record's "mng" value
 * @method Mobile              setAnimationGif()             Sets the current record's "animation_gif" value
 * @method Mobile              setTransparentGif()           Sets the current record's "transparent_gif" value
 * @method Mobile              setAmc()                      Sets the current record's "amc" value
 * @method Mobile              setAsf()                      Sets the current record's "asf" value
 * @method Mobile              set3g2()                      Sets the current record's "3g2" value
 * @method Mobile              set3gp()                      Sets the current record's "3gp" value
 * @method Mobile              setChord()                    Sets the current record's "chord" value
 * @method Mobile              setMusic()                    Sets the current record's "music" value
 * @method Mobile              setFullMusic()                Sets the current record's "full_music" value
 * @method Mobile              setMovie()                    Sets the current record's "movie" value
 * @method Mobile              setHugeMovie()                Sets the current record's "huge_movie" value
 * @method Mobile              setAppli()                    Sets the current record's "appli" value
 * @method Mobile              setAppliType()                Sets the current record's "appli_type" value
 * @method Mobile              setAppliVersion()             Sets the current record's "appli_version" value
 * @method Mobile              setAppliCapacity()            Sets the current record's "appli_capacity" value
 * @method Mobile              setFlash()                    Sets the current record's "flash" value
 * @method Mobile              setFlashVersion()             Sets the current record's "flash_version" value
 * @method Mobile              setGps()                      Sets the current record's "gps" value
 * @method Mobile              setDressUp()                  Sets the current record's "dress_up" value
 * @method Mobile              setSsl()                      Sets the current record's "ssl" value
 * @method Mobile              setCookie()                   Sets the current record's "cookie" value
 * @method Mobile              setUtn()                      Sets the current record's "utn" value
 *
 * @package     sfJpMobile
 * @subpackage  device
 * @author      YUKI Kaoru <yuki@yagni.jp>
 * @version     $Id$
 */
abstract class sfJpMobileDevice
{
    /**
     * @var string model name
     */
    public $id;
    /**
     * @var Mobile 端末情報
     */
    protected $info = false;
    /**
     * constructor
     */
    public function __construct()
    {
        $this->parse();
        $this->getInfo();
    }
    /**
     * parse UserAgent
     * @throws  sfMobilenotDetermineException
     * @return  null
     */
    public abstract function parse();
    /**
     * get device id
     * @return  string
     */
    public function getId()
    {
        if (!$this->id) {
            if ($ua = getenv('HTTP_USER_AGENT')) {
                if (preg_match('!^MOT-([^/]+)!', $ua, $matches)) {
                    $this->id = $matches[1];
                } else if (preg_match('!^.+?/.+?/([^/]+)!', $ua, $matches)) {
                    $this->id = $matches[1];
                }
                return null;
            }
        }
        return $this->id;
    }
    /**
     * 端末情報の取得
     */
    private function getInfo()
    {
        if ($this->info === false) {
            $event = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, "sf_jpmobile.get_device_info", array()));
            if ($event->isProcessed()) {
                $this->info = $event->getReturnValue();
            } else {
                $this->info = MobileTable::getInstance()->find($this->getId());
            }
        }
        return $this->info;
    }
    public function __call($name, $args)
    {
        $event = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, "sf_jpmobile.call_device_method", array("name" => $name, "args" => $args)));
        if ($event->isProcessed()) {
            return $event->getReturnValue();
        }
        return call_user_func(array($this->info, $name), $args);
    }
    public function __get($name)
    {
        $event = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, "sf_jpmobile.get_device_data", array("name" => $name)));
        if ($event->isProcessed()) {
            return $event->getReturnValue();
        }
        return $this->info->$name;
    }
    public function __set($name, $value)
    {
        $event = sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, "sf_jpmobile.set_device_data", array("name" => $name, "value" => $value)));
        if (!$event->isProcessed()) {
            $this->info->$name = $value;
        }
    }
}

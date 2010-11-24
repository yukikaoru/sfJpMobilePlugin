<?php
/* vim:set et ts=4 sts=4 sw=4: */
/**
 * 携帯用セッションストレージ
 *
 * @package       sfJpMobile
 * @subpackage    storage
 * @version       $Id$
 */
class sfJpMobileSessionStorage extends sfSessionStorage
{
    /**
     * @return null
     */
    public function initialize($options = null)
    {
        if (sfJpMobile::getInstance()->isMobile()) {
            ini_set("session.use_trans_sid", 1);
            ini_set("session.use_cookies", 0);
            ini_set("session.use_only_cookies", 0);
        } else {
            ini_set("session.use_trans_sid", 0);
            ini_set("session.use_cookies", 1);
        }
        parent::initialize($options);
    }
}

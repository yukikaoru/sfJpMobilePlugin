<?php
/* vim: set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
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
    if (sfJpMobile::isMobile()) {
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
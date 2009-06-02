<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * sfJpMobilePlugin configuration.
 *
 * @package     sfJpMobilePlugin
 * @subpackage  config
 * @version     $Id$
 */
class sfJpMobilePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    sfJpMobile::initialize();
  }
}

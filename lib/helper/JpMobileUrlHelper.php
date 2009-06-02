<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 携帯ページ用ヘルパ
 *
 * @package     sfJpMobile
 * @subpackage  helper
 * @version     $Id$
 */

/**
 * generate URI
 * @param   string|array  $param
 * @param   bool          $absolute
 * @return  string
 */
function jpmobile_url_for($param, $absolute = false)
{
  $url = url_for($param, $absolute);
  if (sfJpMobile::isDocomo()) {
    $url .= "?guid=ON";
  }
  return $url;
}
/**
 * a tag
 * @param  string $name          name of the link, i.e. string to appear between the <a> tags
 * @param  string $internal_uri  'module/action' or '@rule' of the action
 * @param  array  $options       additional HTML compliant <a> tag parameters
 */
function jpmobile_link_to($name, $internal_uri = '', $options = array())
{
  $url = jpmobile_url_for($internal_uri);
  return link_to($name, $url, $options);
}
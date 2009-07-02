<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 携帯用ヘルパー
 *
 * @package     sfJpMobile
 * @subpackage  helper
 * @version     $Id$
 */

/**
 * 入力文字種類制御の属性を追加する(Formのattribute用)
 * 
 * @param   integer   $style    DoCoMoのistyle属性の値
 * @param   array     $attr     合成元の属性
 * @return  array
 */
function add_istyle($style, $attr = array())
{
  $data = new stdClass();
  $carrier = sfJpMobile::getShortCarrierName();
  $config = sfConfig::get("jpmobile_istyle_{$carrier}");
  switch ($carrier) {
    case 'dc':
    case 'au':
    case 'sb':
      $data->style = $config['style'][$style - 1];
    break;
    default:
    break;
  }
  foreach ($data as $k => $v) {
    if (array_key_exists($k, $attr)) {
      $attr[$k] .= $v;
    } else {
      $attr[$k] = $v;
    }
  }
  return $attr;
}

/**
 * 入力文字種類制御の属性を生成
 *
 * @param   integer   $style    DoCoMoのistyle属性の値
 * @return  string
 */
function istyle($style)
{
  $result = '';
  foreach (add_istyle($style) as $k => $v) {
    $result .= "{$k}=\"{$v}\"";
  }
  return $result;
}


<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 基本絵文字クラス
 *
 * @package     sfJpMobile
 * @subpackage  emoji
 * @version     $Id: c91f5e46986310dd91ad9a92cda78305fa3ebd03 $
 */
abstract class sfJpMobileEmoji
{
  /**
   * 変換テーブル
   * @var array
   */
  protected $_decTable = array();
  /**
   * エンコードテーブル
   * @var array
   */
  protected $_encTable = array();
  /**
   * Webコード検出パターン
   * @var string
   */
  protected $_webCodeRegex = '/(&#xE(?:6|7)[A-F0-9]{2};)/i';
  /**
   * バイナリコード検出パターン
   * @var string
   */
  protected $_binCodeRegex;

  /**
   * constructor
   */
  public function __construct()
  {
    // 絵文字変換テーブルの読み込み
    if (!sfJpMobile::isDocomo()) {
      $this->_decTable = sfYaml::load(dirname(__FILE__) . '/../../config/' . strtolower(sfJpMobile::getShortCarrierName()) . '_dec.yml');
      $this->_encTable = sfYaml::load(dirname(__FILE__) . '/../../config/' . strtolower(sfJpMobile::getShortCarrierName()) . '_enc.yml');
    } else {
      $this->_encTable = sfYaml::load(dirname(__FILE__) . '/../../config/dc_enc.yml');
    }
    $this->initialize();
  }
  /**
   * initialize
   * @return null
   */
  public function initialize(){}
  /**
   * 変換
   * @param   string    $str    変換対象
   * @return  string
   */
  public function convert($str)
  {
    foreach ($this->findTextCode($str) as $key) {
      if (array_key_exists($key, $this->_decTable)) {
        $str = str_replace($key, $this->_decTable[$key], $str);
      }
    }
    return $str;
  }
  /**
   * DoCoMo用16進数コードへのエンコード
   * @param   string    $str    対象
   * @return  string
   */
  public function encode($str)
  {
    foreach ($this->findBin($str) as $bin) {
      $hex = bin2hex($bin);
      $replace = array_key_exists($hex, $this->_encTable) ? $this->_encTable[$hex] : '';
      $str = str_replace($bin, $replace, $str);
    }
    return $str;
  }
  /**
   * DoCoMo絵文字テキストコード検出
   * @param   string    $str    検索対象文字列
   * @return  array
   */
  public function findTextCode($str)
  {
    $matches = array();
    if (preg_match_all($this->_webCodeRegex, $str, $matches)) {
      $matches = array_unique($matches[0]);
    }
    return $matches;
  }
  /**
   * バイナリ絵文字検出
   * @param   string    $str    検索対象文字列
   * @return  array
   */
  public function findBin($str)
  {
    $result = array();
    if (preg_match_all($this->_binCodeRegex, $str, $match)) {
      $result = array_unique($match[0]);
    }
    return $result;
  }

}

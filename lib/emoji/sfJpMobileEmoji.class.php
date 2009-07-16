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
  protected $_decTable;
  /**
   * エンコードテーブル
   * @var array
   */
  protected $_encTable;
  /**
   * Webコード検出パターン
   * @var string
   */
  protected $_webCodeRegex = '/&(#xE(?:6|7)[A-F0-9]{2});/i';
  /**
   * テキストコード検出パターン
   * @var string
   */
  protected $_textCodeRegex = '/\[(#xE(?:6|7)[A-F0-9]{2})\]/i';
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
    include sfContext::getInstance()->getConfigCache()->checkConfig('config/jpmobile/emoji/' . strtolower(sfJpMobile::getShortCarrierName()) . '_dec.yml');
    include sfContext::getInstance()->getConfigCache()->checkConfig('config/jpmobile/emoji/' . strtolower(sfJpMobile::getShortCarrierName()) . '_enc.yml');
    $this->_decTable = sfConfig::get('jpmobile_emoji_dec', array());
    $this->_encTable = sfConfig::get('jpmobile_emoji_enc', array());
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
    foreach ($this->findWebCode($str) as $key) {
      if (array_key_exists($key, $this->_decTable)) {
        $str = str_replace("&{$key};", $this->_decTable[$key], $str);
      }
    }
    return $str;
  }
  /**
   * 各キャリア用のコードへのデコード
   * @param   string    $str    変換対象
   * @return  string
   */
  public function decode($str)
  {
    foreach ($this->findTextCode($str) as $key) {
      if (array_key_exists($key, $this->_decTable)) {
        $str = str_replace("[{$key}]", $this->_decTable[$key], $str);
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
      $replace = array_key_exists($hex, $this->_encTable) ? "[{$this->_encTable[$hex]}]" : '';
      $str = str_replace($bin, $replace, $str);
    }
    return $str;
  }
  /**
   * 絵文字の削除
   * @param   string    $str    対象
   * @return  string
   */
  public function trim($str)
  {
    foreach ($this->findBin($str) as $bin) {
      $str = str_replace($bin, '', $str);
    }
    return $str;
  }
  /**
   * DoCoMo絵文字Web記述用コード検出
   * @param   string    $str    検索対象文字列
   * @return  array
   */
  public function findWebCode($str)
  {
    $result = array();
    if (preg_match_all($this->_webCodeRegex, $str, $matches)) {
      $result = array_unique($matches[1]);
    }
    return $result;
  }
  /**
   * DoCoMo絵文字テキストコード検出
   * @param   string    $str    検索対象文字列
   * @return  array
   */
  public function findTextCode($str)
  {
    $result = array();
    if (preg_match_all($this->_textCodeRegex, $str, $matches)) {
      $result = array_unique($matches[1]);
    }
    return $result;
  }
  /**
   * バイナリ絵文字検出
   * @param   string    $str    検索対象文字列
   * @return  array
   */
  public function findBin($str)
  {
    $result = array();
    if (preg_match_all($this->_binCodeRegex, $str, $matches)) {
      $result = array_unique($matches[0]);
    }
    return $result;
  }

}

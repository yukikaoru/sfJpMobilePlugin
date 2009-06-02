<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 携帯ページ用コントローラ
 *
 * @package     sfJpMobilePlugin
 * @subpackage  controller
 * @version     $Id$
 */
class sfJpMobileController extends sfFrontWebController
{
  public function getView($moduleName, $actionName, $viewName)
  {
    // user view exists?
    $file = sfConfig::get('sf_app_module_dir') . '/' . $moduleName . '/view/'
          . $actionName . $viewName . 'View.class.php';

    if (is_readable($file)) {
      require_once($file);

      $class = $actionName.$viewName.'View';

      // fix for same name classes
      $moduleClass = $moduleName.'_'.$class;

      if (class_exists($moduleClass, false)) {
        $class = $moduleClass;
      }
    } else {
      // view class (as configured in module.yml or defined in action)
      $class = sfConfig::get('app_view_class', 'sfJpMobile').'View';
      if (!class_exists($class)) {
        $class = sfConfig::get('mod_'.strtolower($moduleName).'_view_class', 'sfPHP').'View';
      }
    }

    return new $class($this->context, $moduleName, $actionName, $viewName);
  }
}
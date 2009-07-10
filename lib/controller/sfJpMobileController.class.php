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
  /**
   * @see sfWebController
   */
  public function genUrl($parameters = array(), $absolute = false)
  {
    $url = parent::genUrl($parameters, $absolute);
    if (sfJpMobile::isDocomo()) {
      if (!preg_match('/(\?|&)guid=/', $url)) {
        $url .= (strpos($url, '?') === false ? '?' : '&') . 'guid=ON';
      }
    }
    return $url;
  }
  /**
   * @see sfWebController
   */
  public function redirect($url, $delay = 0, $statusCode = 302)
  {
    $url = $this->genUrl($url, true);

    if (sfJpMobile::isMobile() && !preg_match('/(\?|&)'.preg_quote(SID).'/', $url)) {
      $url .= (strpos($url, '?') === false ? '?' : '&') . SID;
    }

    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->dispatcher->notify(new sfEvent($this, 'application.log', array(sprintf('Redirect to "%s"', $url))));
    }

    // redirect
    $response = $this->context->getResponse();
    $response->clearHttpHeaders();
    $response->setStatusCode($statusCode);
    $response->setHttpHeader('Location', $url);
    $response->setContent(sprintf('<html><head><meta http-equiv="refresh" content="%d;url=%s"/></head></html>', $delay, htmlspecialchars($url, ENT_QUOTES, sfConfig::get('sf_charset'))));
    $response->send();
  }
  /**
   * @see sfController
   */
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

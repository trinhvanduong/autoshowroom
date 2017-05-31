<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;

// Include the helper file
require_once dirname(__FILE__) . '/helper.php';
$mod_ID = $module->id;
// if cURL is disabled, then extension cannot work
if (!is_callable('curl_init')) {
    $data = false;
    $curlDisabled = true;
} else {
    $model = new modTzTwitterWidgetHelper();
    $model->addStyles($params, $mod_ID);
    $data = $model->getData($params);
}
$doc = JFactory::getDocument();



//$doc->addStyleDeclaration($styles . $border);
//$doc->addStyleSheet(JUri::root() . '/modules/mod_tz_twitterwidget/css/tztwitterwidget.css');
$switch_api = $params->get('switch_api', 1);


require JModuleHelper::getLayoutPath('mod_tz_twitterwidget', $params->get('layout', 'default'));

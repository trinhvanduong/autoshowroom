<?php
/*------------------------------------------------------------------------

# TZ Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$contact    = modTZContactHelper::getContact($params);
$form       = modTZContactHelper::getForm($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

// Manage the display mode for contact detail groups

require JModuleHelper::getLayoutPath('mod_tz_contact', $params->get('layout', 'default'));
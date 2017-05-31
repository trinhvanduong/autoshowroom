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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemTZ_Menu_Params extends JPlugin
{
    public function onContentPrepareForm($form, $data)
    {
        $app = JFactory::getApplication();

        if ($app->isAdmin()) {
            $input = $app->input;
            $name = $form->getName();
            if ($name == 'com_modules.module') {
                $language = JFactory::getLanguage();
                $language->load('plg_system_tz_menu_params');
                JForm::addFormPath(__DIR__ . '/forms');
                $form->loadFile('param_module', false);

            }
            if ($name == 'com_fields.fieldcom_contact.contact') {
                $language = JFactory::getLanguage();
                $language->load('plg_system_tz_menu_params');
                JForm::addFormPath(__DIR__ . '/forms');
                $form->loadFile('contact_customfield', false);

            }
            if ($name == 'com_menus.item') {
                $language = JFactory::getLanguage();
                $language->load('plg_system_tz_menu_params');
                JForm::addFormPath(__DIR__ . '/forms');
                $form->loadFile('param_menu', false);
            }

        }
        return true;
    }

}
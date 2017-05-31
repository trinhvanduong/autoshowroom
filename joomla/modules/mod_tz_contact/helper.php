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

jimport('joomla.application.component.model');

JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_contact/models', 'ContactModel');

class modTZContactHelper{
    public static function getContact(&$params){
        if($params -> get('contactid')){
            $app    = JFactory::getApplication();
            if($app -> input -> get('option') == 'com_contact'){
                $comParams  = $app -> getParams();
            }
            else{
                $comParams  = $app -> getParams('com_contact');
            }

            $model  = JModelLegacy::getInstance('Contact','ContactModel',array('ignore_request' => true));
            $model->setState('params',$comParams);
            $model -> setState('contact.id',$params -> get('contactid'));

            // Access filter
            $access = !JComponentHelper::getParams('com_contact')->get('show_noauth');
            $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
            $model->setState('filter.access', $access);

            if($item   = $model -> getItem()){
                if($item -> published == 1){
                    return $item;
                }
            }
        }

        return null;
    }

    public static function getForm(&$params){
    }
}
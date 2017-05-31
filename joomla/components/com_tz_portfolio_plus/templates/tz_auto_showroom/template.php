<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access
defined('_JEXEC') or die;
//var_dump($this -> params->get('load_style'));die();
if(!$this -> params -> get('load_style')){
//    var_dump('aaaaaaaaaaaa');die();
    $doc    = JFactory::getDocument();
    $tpl_path   = TZ_Portfolio_PlusUri::base(true).'/templates/tz_auto_showroom/css/template.css';
    unset($this -> _styleSheets[$tpl_path]);
}
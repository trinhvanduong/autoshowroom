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

defined('_JEXEC') or die();

require_once dirname(__FILE__) . '/helper.php';
$doc = JFactory::getDocument();
if ($params->get('tz_use_font_icon', 0)) {
    $doc->addStyleSheet(JUri::base() . 'modules/mod_tz_plus_gallery_pro/css/font-awesome.css');
}
$title_album = $params->get('album_title');
$tztype = $params->get('tztype');
$facebook_id = $params->get('fb_id');
$flickr_id = $params->get('flickr_id');
$instagram_id = $params->get('instagram_id');
$google_plus_id = $params->get('gplus_id');

$type_album = $params->get('type_album');
$single_album_id = $params->get('single_album_id');
$ex_album_id = str_replace(' ', "", $params->get('ex_album_id', ''));
$in_album_id = str_replace(' ', "", $params->get('in_album_id', ''));

$photo_limit = $params->get('photo_limit');
$album_limit = $params->get('album_limit');

$instagram_data_access_token = $params->get('instagram_data_access_token', '');
$album_desc = $params->get('album_desc');
$tz_columns = $params->get('tz_columns');
$tz_columns_small_desktop = $params->get('tz_columns_small_desktop');
$tz_columns_tablet = $params->get('tz_columns_tablet');
$tz_columns_mobile = $params->get('tz_columns_mobile');
$tz_padding = $params->get('tz_padding');
$tz_show_title_album = $params->get('tz_show_title_album');
$tz_show_desc_album = $params->get('tz_show_desc_album');
$tz_color_box = $params->get('tz_color_box');
$height_item = $params->get('tz_height_item');
$margin_box_parent = $params->get('tz_margin');
$load_more_nav = $params->get('tz_use_load_more');
$access_token_fb = $params->get('fb_access_token');
if ($load_more_nav) {
    $nav_hide = '';
} else {
    $nav_hide = ' nav_hide';
}

$layout = $params->get('layout', 'default');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_tz_plus_gallery_pro', $layout);

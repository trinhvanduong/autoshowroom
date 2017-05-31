<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonGallery extends SppagebuilderAddons
{

    public function render()
    {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

        //Options
        $width = (isset($this->addon->settings->width) && $this->addon->settings->width) ? $this->addon->settings->width : 200;
        $height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 200;

        $output = '<div class="lightgallery sppb-addon sppb-addon-gallery ' . $class . '">';
        $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
        $output .= '<div class="sppb-addon-content">';
        $output .= '<ul class="clearfix row autoshowroom-lightgallery">';

        foreach ($this->addon->settings->sp_gallery_item as $key => $value) {
            if ($value->thumb) {
                $src_img = ($value->full) ? ' data-src="' . JUri::base() . $value->full . '"' : '';
                $output .= '<li class="col-lg-6 pt-15 pb-15"' . $src_img . '>';
//                $output .= ($value->full) ? '<a href="' . $value->full . '" class="sppb-gallery-btn">' : '';
                $output .= '<a href="#"><img class="" src="' . $value->thumb . '" alt="' . $value->title . '"></a>';
//                $output .= ($value->full) ? '</a>' : '';
                $output .= '</li>';
            }
        }

        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public function stylesheets()
    {
        return array(JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/css/lightgallery.min.css');
    }

    public function scripts()
    {
        return array(JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lightgallery.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-thumbnail.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-autoplay.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-fullscreen.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-hash.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-pager.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-share.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-video.min.js',
            JURI::base(true) . '/templates/' . JFactory::getApplication()->getTemplate() . '/js/lg-zoom.min.js');
    }

    public function js()
    {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $js = 'jQuery(function($){
			$("' . $addon_id . ' ul").lightGallery();
		})';

        return $js;
    }

}

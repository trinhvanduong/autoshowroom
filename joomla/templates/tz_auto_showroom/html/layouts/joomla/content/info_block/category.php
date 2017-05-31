<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
<span class="category-name"><?php $title = $this->escape($displayData['item']->category_title); ?>
    <i class="fa fa-folder-o"
       aria-hidden="true"></i><?php if ($displayData['params']->get('link_category') && $displayData['item']->catslug) : ?><?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?><?php echo  $url; ?><?php else : ?><?php echo  '<span itemprop="genre">' . $title . '</span>'; ?><?php endif; ?>
</span>
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_categories
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

foreach ($list as $item) : ?>
    <li <?php if ($_SERVER['REQUEST_URI'] === JRoute::_(ContentHelperRoute::getCategoryRoute($item->id))) echo ' class="active"'; ?>> <?php $levelup = $item->level - $startLevel - 1; ?>
        <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)); ?>">
            <i class="fa fa-arrow-circle-right"></i><?php echo $item->title; ?>
            <?php if ($params->get('numitems')) : ?>
                <em>(<?php echo $item->numitems; ?>)</em>
            <?php endif; ?>
        </a>


        <?php if ($params->get('show_description', 0)) : ?>
            <?php echo JHtml::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content'); ?>
        <?php endif; ?>
        <?php if ($params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0)
                || ($params->get('maxlevel') >= ($item->level - $startLevel)))
            && count($item->getChildren())
        ) : ?>
            <?php echo '<ul>'; ?>
            <?php $temp = $list; ?>
            <?php $list = $item->getChildren(); ?>
            <?php require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default') . '_items'); ?>
            <?php $list = $temp; ?>
            <?php echo '</ul>'; ?>
        <?php endif; ?>
    </li>
<?php endforeach; ?>

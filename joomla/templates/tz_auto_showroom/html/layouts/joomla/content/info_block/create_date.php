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
			<span class="create">
					<time datetime="<?php echo JHtml::_('date', $displayData['item']->created, 'c'); ?>" itemprop="dateCreated">
						<i class="fa fa-calendar" aria-hidden="true"></i><?php echo  JHtml::_('date', $displayData['item']->created, JText::_('DATE_FORMAT_LC3')); ?>
					</time>
			</span>
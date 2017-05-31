<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="newsflash<?php echo $moduleclass_sfx; ?>">
    <?php foreach ($list as $item) : ?>
        <li class="newsflash-item">
            <?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
        </li>
    <?php endforeach; ?>
</ul>
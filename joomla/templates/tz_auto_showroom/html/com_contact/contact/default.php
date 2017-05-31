<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->params;
jimport('joomla.html.html.bootstrap');
?>
<?php $show_contact_category = $tparams->get('show_contact_category'); ?>
<?php if ($tparams->get('show_page_heading')) : ?>
    <h1>
        <?php echo $this->escape($tparams->get('page_heading')); ?>
    </h1>
<?php endif; ?>
<div class="contact<?php echo $this->pageclass_sfx; ?> tz__contact" itemscope itemtype="https://schema.org/Person">
    <div class="tz__contact__left">
        <?php if ($this->contact->image && $tparams->get('show_image')) : ?>
            <div class="tz__contact__image">
                <?php echo JHtml::_('image', $this->contact->image, $this->contact->name, array('align' => 'middle', 'itemprop' => 'image')); ?>
            </div>
        <?php endif; ?>
        <div class="tz__contact__info">
            <?php if ($show_contact_category === 'show_no_link') : ?>
                <h3 class="contact-category"><?php echo $this->contact->category_title; ?></h3>
            <?php elseif ($show_contact_category === 'show_with_link') : ?>
                <?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
                <h3 class="contact-category"><a href="<?php echo $contactLink; ?>">
                        <?php echo $this->escape($this->contact->category_title); ?></a>
                </h3>
            <?php endif; ?>

            <?php //echo $this->item->event->afterDisplayTitle; ?>

            <?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
                <form action="#" method="get" name="selectForm" id="selectForm" class="selectForm">
                    <?php echo '<span>'.JText::_('COM_CONTACT_SELECT_CONTACT').'</span>'; ?>
                    <?php echo JHtml::_('select.genericlist', $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
                </form>
            <?php endif; ?>
            <?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
                <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
                <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
            <?php endif; ?>
            <?php if ($this->params->get('show_info', 1)) : ?>
                <?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
                    <div class="contact-position dl-horizontal">
                        <span itemprop="jobTitle">
                            <?php echo $this->contact->con_position; ?>
                        </span>
                    </div>
                <?php endif; ?>

                <?php echo $this->loadTemplate('address'); ?>

                <?php if ($tparams->get('allow_vcard')) : ?>
                    <div class="block__card">
                        <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
                        <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
                            <?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
                    </div>
                <?php endif; ?>


            <?php endif; ?>
            <?php if ($tparams->get('show_links')) : ?>
                <?php echo $this->loadTemplate('links'); ?>
            <?php endif; ?>
            <?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
                <?php echo $this->loadTemplate('profile'); ?>
            <?php endif; ?>

            <?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
                <?php echo $this->loadTemplate('user_custom_fields'); ?>
            <?php endif; ?>

            <?php if ($this->contact->jcfields): ?>
                <ul>
                    <?php foreach ($this->contact->jcfields as $jcfield): ?>
                        <li>
                            <?php if ($jcfield->params->get('icon')) {
                                echo '<div class="block__icon"><i class="' . $jcfield->params->get('icon') . '"></i></div>';
                            } ?>
                            <div class="block__content">
                                <?php echo '<label>' . $jcfield->title . '</label>';
                                echo $jcfield->value; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="tz__contact__right">
        <?php if ($this->contact->name && $tparams->get('show_name')) : ?>
            <h2 class="page-header">
                <?php if ($this->item->published == 0) : ?>
                    <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
                <?php endif; ?>
                <span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
            </h2>
        <?php endif; ?>

        <?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>

            <div class="tz__contact__miscinfo">
                <?php echo $this->contact->misc; ?>
            </div>

        <?php endif; ?>

        <?php //echo $this->item->event->beforeDisplayContent; ?>

        <?php $presentation_style = $tparams->get('presentation_style'); ?>

        <?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
            <?php echo $this->loadTemplate('form'); ?>
        <?php endif; ?>

        <?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>

            <?php echo '<h3>' . JText::_('JGLOBAL_ARTICLES') . '</h3>'; ?>


            <?php echo $this->loadTemplate('articles'); ?>

        <?php endif; ?>

        <?php echo $this->item->event->afterDisplayContent; ?>
    </div>
</div>

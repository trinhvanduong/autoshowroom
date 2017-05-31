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

defined('_JEXEC') or die;
JFactory::getLanguage()->load('com_contact');
require_once(JPATH_LIBRARIES . '/cms/plugin/helper.php');
?>
<?php if ($params->get('show_email_form', 1)): ?>
    <form class="form-validate form-horizontal span9" method="post" action="<?php echo JRoute::_('index.php'); ?>"
          id="contact-form">
        <fieldset>

            <div class="input-left span5">
                <input type="text" aria-required="true" size="30" class="required inputbox"
                       placeholder="<?php echo JText::_('TPL_TZ_ARAGON_CONTACT_EMAIL_NAME_LABEL'); ?>"
                       value="" id="jform_contact_name" name="jform[contact_name]">
                <input type="email" aria-required="true" size="30" value=""
                       placeholder="<?php echo JText::_('TPL_TZ_ARAGON_CONTACT_EMAIL_LABEL'); ?>"
                       id="jform_contact_email" class="validate-email required inputbox" name="jform[contact_email]">

                <?php if ($params->get('show_subject', 0)): ?>
                    <input type="text" aria-required="true" size="60" class="inputbox required" value=""
                           id="jform_contact_emailmsg" name="jform[contact_subject]"
                           placeholder="<?php echo JText::_('COM_CONTACT_CONTACT_MESSAGE_SUBJECT_LABEL'); ?>">
                <?php endif; ?>

                <?php if ($params->get('show_email_copy', 1)): ?>
                    <div class="emailCopy">
                        <input type="checkbox" value="1" id="jform_contact_email_copy" class="inputbox "
                               name="jform[contact_email_copy]">
                        <label
                            for="jform_contact_email_copy"><?php echo JText::_('TPL_TZ_ARAGON_CONTACT_EMAIL_COPY_LABEL'); ?></label>
                    </div>
                <?php endif; ?>
                <span class="text"><?php echo JText::_('TPL_TZ_ARAGON_CONTACT_SECURITY'); ?></span>
            </div>
            <div class="input-right span7">
                <textarea aria-required="true" class="required inputbox" rows="10" cols="50"
                          placeholder="<?php echo JText::_('TPL_TZ_ARAGON_CONTACT_ENTER_MESSAGE_LABEL'); ?>"
                          id="jform_contact_message" name="jform[contact_message]"></textarea>

                <?php if ($params->get('show_captcha', 1)): ?>
                    <?php   JPluginHelper::importPlugin('captcha');
                    $dispatcher = JDispatcher::getInstance();
                    $dispatcher->trigger('onInit', 'dynamic_recaptcha_1');?>
                    <div id="dynamic_recaptcha_1"></div>
                <?php endif; ?>
                <div class="form-actions">
                    <div class="tz-contact-button-bar">
                        <button type="button" class="btn validate" id="tz-contact-send">
                            <?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?>
                        </button>
                    </div>
                    <div id="message-sent-false"><?php echo JText::_('JGLOBAL_VALIDATION_FORM_FAILED'); ?></div>
                    <div id="message-sent"><?php echo JText::_('TPL_TZ_ARAGON_SENT_SUCCESSFULLY'); ?></div>
                </div>
            </div>

        </fieldset>
    </form>
<?php endif; ?>
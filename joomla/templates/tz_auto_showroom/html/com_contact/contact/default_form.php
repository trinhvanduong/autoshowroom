<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

?>
<div class="contact-form">
    <form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
        <fieldset>
            <div class="control-group mb-15">
                <div class="controls">
                    <input type="text" name="jform[contact_name]" id="jform_contact_name" value=""
                           placeholder="<?php echo JText::_('TPL_CONTACT_NAME') ?>"
                           class="required form-control input-sm bg-transparent" size="30" required="required"
                           aria-required="true">
                </div>
            </div>
            <div class="control-group mb-15">
                <div class="controls">
                    <input type="email" name="jform[contact_email]"
                           class="validate-email required form-control input-sm bg-transparent"
                           placeholder="<?php echo JText::_('TPL_CONTACT_EMAIL') ?>"
                           id="jform_contact_email" value="" size="30" autocomplete="email"
                           required="required" aria-required="true">
                </div>
            </div>
            <div class="control-group mb-15">
                <div class="controls">
                    <input type="text" name="jform[contact_subject]" id="jform_contact_emailmsg"
                           placeholder="<?php echo JText::_('TPL_CONTACT_SUBJECT') ?>"
                           value="" class="required form-control input-sm bg-transparent" size="60" required="required"
                           aria-required="true">
                </div>
            </div>
            <div class="control-group mb-15">
                <div class="controls">
                    <textarea name="jform[contact_message]" id="jform_contact_message" cols="50"
                              placeholder="<?php echo JText::_('TPL_CONTACT_MESSAGE') ?>"
                              rows="10" class="required form-control input-sm bg-transparent" required="required"
                              aria-required="true"></textarea>
                </div>
            </div>
            <?php if ($this->params->get('show_email_copy')): ?>
                <div class="control-group check-box mb-15">
                    <div class="controls">
                        <input type="checkbox" name="jform[contact_email_copy]" id="jform_contact_email_copy" value="1">
                    </div>
                    <div class="control-label">
                        <label id="jform_contact_email_copy-lbl" for="jform_contact_email_copy" class="hasPopover"
                               title=""
                               data-content="Sends a copy of the message to the address you have supplied."
                               data-original-title="Send a copy to yourself">
                            Send a copy to yourself</label>
                        <span class="optional">(optional)</span>
                    </div>
                </div>
            <?php endif; ?>
            <?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
                <?php
                if ($fieldset->name === 'captcha' && $this->captchaEnabled) : ?>

                    <?php $fields = $this->form->getFieldset($fieldset->name); ?>
                    <?php if (count($fields)) : ?>

                        <?php if (isset($fieldset->label) && ($legend = trim(JText::_($fieldset->label))) !== '') : ?>
                            <legend><?php echo $legend; ?></legend>
                        <?php endif; ?>
                        <?php foreach ($fields as $field) : ?>
                            <?php echo $field->renderField(); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </fieldset>
        <div class="control-group mt-15 mb-15">
            <div class="controls">
                <button class="btn btn-primary validate btn-block text-uppercase" type="submit"><?php echo JText::_('TPL_CONTACT_SEND')?></button>
                <input type="hidden" name="option" value="com_contact">
                <input type="hidden" name="task" value="contact.submit">
                <input type="hidden" name="return" value="">
                <input type="hidden" name="id" value="2:get-in-touch">
                <input type="hidden" name="b2b338f7976d790490b86ddf8d00c6da" value="1"></div>
        </div>
    </form>
</div>

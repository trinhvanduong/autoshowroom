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

?>
<?php if ($params->get('show_street_address', 1) OR $params->get('show_suburb', 1)
    OR $params->get('show_state', 1) OR $params->get('show_postcode', 1)
    OR $params->get('show_country', 1) OR $params->get('show_email', 1)
    OR $params->get('show_fax', 1) OR $params->get('show_mobile', 1)
    OR $params->get('show_webpage', 1)
): ?>
    <div class="contact-address dl-horizontal span3">
        <?php if ($params->get('show_street_address', 1) OR $params->get('show_suburb', 1)
            OR $params->get('show_state', 1) OR $params->get('show_postcode', 1)
            OR $params->get('show_country', 1) OR $params->get('show_fax', 1)
        ): ?>
            <div class="info">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                <?php if (!empty($contact->address)): ?>
                    <span class="contact-street"><?php echo $contact->address; ?></span>
                <?php endif; ?>

                <?php if (!empty($contact->suburb)): ?>
                    <span class="contact-suburb"><?php echo $contact->suburb; ?></span>
                <?php endif; ?>

                <?php if (!empty($contact->state)): ?>
                    <span class="contact-state"><?php echo $contact->state; ?></span>
                <?php endif; ?>

                <?php if (!empty($contact->postcode)): ?>
                    <span class="contact-postcode"><?php echo $contact->postcode; ?></span>
                <?php endif; ?>

                <?php if (!empty($contact->country)): ?>
                    <span class="contact-country"><?php echo $contact->country; ?></span>
                <?php endif; ?>
                    </span>
            </div>
        <?php endif; ?>

        <?php if ($params->get('show_email', 1)): ?>
            <?php if (!empty($contact->email_to)): ?>
                <div class="info">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span class="contact-emailto"><?php echo $contact->email_to; ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_fax', 1) OR $params->get('show_mobile', 1)): ?>
            <?php if (!empty($contact->telephone) OR !empty($contact->mobile)): ?>

                <?php if (!empty($contact->telephone)): ?>
                    <div class="info">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span class="contact-telephone"><?php echo nl2br($contact->telephone); ?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($contact->mobile)): ?>
                    <div class="info">
                        <i class="fa fa-mobile" aria-hidden="true"></i>
                        <span class="contact-mobile"><?php echo nl2br($contact->mobile); ?></span>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_fax', 1)): ?>
            <?php if (!empty($contact->fax)): ?>
                <div class="info">
                    <i class="fa fa-fax" aria-hidden="true"></i>
                    <span class="contact-fax"><?php echo nl2br($contact->fax); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($params->get('show_webpage', 1)): ?>
            <?php if (!empty($contact->webpage)): ?>
                <div class="info">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <span class="contact-webpage"><a href="<?php echo $contact->webpage; ?>"
                                                     target="_blank"><?php echo $contact->webpage; ?></a></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
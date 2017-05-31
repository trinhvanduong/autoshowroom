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
<?php if($params -> get('show_street_address',1) OR $params -> get('show_suburb',1)
    OR $params -> get('show_state',1) OR $params -> get('show_postcode',1)
    OR $params -> get('show_country',1) OR $params -> get('show_email',1)
    OR $params -> get('show_fax',1) OR $params -> get('show_mobile',1)
    OR $params -> get('show_webpage',1)):?>
    <div class="contact-address dl-horizontal span3">
        <?php if($params -> get('show_street_address',1) OR $params -> get('show_suburb',1)
            OR $params -> get('show_state',1) OR $params -> get('show_postcode',1)
            OR $params -> get('show_country',1) OR $params -> get('show_fax',1)):?>
            <div class="contact-icon">
            <span class="<?php echo $params->get('marker_class'); ?>" >
                <?php echo $params->get('marker_address'); ?>
            </span>
            </div>
            <div class="info">
                <?php if(!empty($contact -> address)):?>
                    <span class="contact-street">
                <?php echo $contact->address .'<br/>'; ?>
            </span>
                <?php endif;?>

                <?php if(!empty($contact -> suburb)):?>
                    <span class="contact-suburb">
                <?php echo $contact->suburb .'<br/>'; ?>
            </span>
                <?php endif;?>

                <?php  if(!empty($contact -> state)):?>
                    <span class="contact-state">
                <?php echo $contact->state . '<br/>'; ?>
            </span>
                <?php endif;?>

                <?php if(!empty($contact -> postcode)):?>
                    <span class="contact-postcode">
                <?php echo $contact->postcode .'<br/>'; ?>
            </span>
                <?php endif;?>

                <?php if(!empty($contact -> country)):?>
                    <span class="contact-country">
                <?php echo $contact->country .'<br/>'; ?>
            </span>
                <?php endif;?>
            </div>
        <?php endif;?>

        <?php if($params -> get('show_email',1)):?>
            <?php if(!empty($contact -> email_to)):?>
                <div class="contact-icon">
                <span class="<?php echo $params->get('marker_class'); ?>" >
                    <?php echo nl2br($params->get('marker_email')); ?>
                </span>
                </div>
                <div class="info">
                <span class="contact-emailto">
                    <?php echo $contact->email_to; ?>
                </span>
                </div>
            <?php endif;?>
        <?php endif;?>

        <?php if($params -> get('show_fax',1) OR $params -> get('show_mobile',1)):?>
            <?php if(!empty($contact -> telephone) OR !empty($contact -> mobile)):?>
                <div class="contact-icon">
            <span class="<?php echo $params->get('marker_class'); ?>" >
                <?php echo $params->get('marker_telephone'); ?>
            </span>
                </div>
                <div class="info">
                    <?php if(!empty($contact -> telephone)):?>
                        <span class="contact-telephone">
                <?php echo nl2br($contact->telephone); ?>
            </span>
                    <?php endif;?>
                    <?php if(!empty($contact -> mobile)):?>
                        <span class="contact-mobile">
                <?php echo '<br/>'.nl2br($contact->mobile); ?>
            </span>
                    <?php endif;?>
                </div>
            <?php endif;?>
        <?php endif;?>

        <?php if($params -> get('show_fax',1)):?>
            <?php if(!empty($contact -> fax)):?>
                <div class="contact-icon">
            <span class="<?php echo $params->get('marker_class'); ?>" >
                <?php echo $params->get('marker_fax'); ?>
            </span>
                </div>
                <div class="info">
            <span class="contact-fax">
            <?php echo nl2br($contact->fax); ?>
            </span>
                </div>
            <?php endif;?>
        <?php endif;?>

        <?php if($params -> get('show_webpage',1)):?>
            <?php if(!empty($contact -> webpage)):?>
                <div class="contact-icon">
                    <span class="<?php echo $params->get('marker_class'); ?>"><?php echo $params->get('marker_website'); ?></span>
                </div>
                <div class="info">
            <span class="contact-webpage">
                <a href="<?php echo $contact->webpage; ?>" target="_blank">
                    <?php echo $contact->webpage; ?></a>
            </span>
                </div>
            <?php endif;?>
        <?php endif;?>
    </div>
<?php endif;?>
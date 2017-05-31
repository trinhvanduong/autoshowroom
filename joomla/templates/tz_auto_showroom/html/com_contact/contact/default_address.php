<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<ul class="contact-address dl-horizontal" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
    <?php if (($this->params->get('address_check') > 0) &&
        ($this->contact->address || $this->contact->suburb || $this->contact->state || $this->contact->country || $this->contact->postcode)
    ) : ?>
        <li>
			<span class="block__icon fa fa-location-arrow">
			</span>
            <span class="block__content">

		<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
            <span class="contact-street" itemprop="streetAddress">
					<?php echo nl2br($this->contact->address); ?>
				</span>
        <?php endif; ?>

                <?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
                    <span class="contact-suburb" itemprop="addressLocality">
					<?php echo $this->contact->suburb; ?>
				</span>
                <?php endif; ?>

                <?php if ($this->contact->state && $this->params->get('show_state')) : ?>
                    <span class="contact-state" itemprop="addressRegion">
					<?php echo $this->contact->state; ?>
				</span>
                <?php endif; ?>

                <?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
                    <span class="contact-postcode" itemprop="postalCode">
					<?php echo $this->contact->postcode; ?>
				</span>
                <?php endif; ?>

                <?php if ($this->contact->country && $this->params->get('show_country')) : ?>
                    <span class="contact-country" itemprop="addressCountry">
				<?php echo $this->contact->country; ?>
			</span>
                <?php endif; ?>
    </span>
        </li>
    <?php endif; ?>

    <?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
        <li>
		<span class="block__icon fa fa-envelope" itemprop="email">
		</span>
            <span class="block__content contact-emailto">
			<?php echo $this->contact->email_to; ?>
		</span>
        </li>
    <?php endif; ?>

    <?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
        <li class="mb-0">
		<span class="block__icon fa fa-phone">
		</span>
            <span class=" block__contentcontact-telephone" itemprop="telephone">
			<?php echo $this->contact->telephone; ?>
		</span>
        </li>
    <?php endif; ?>
    <?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
        <li class="mb-0">
		<span class="block__icon fa fa-fax">
		</span>
            <span class="block__content contact-fax" itemprop="faxNumber">
		<?php echo $this->contact->fax; ?>
		</span>
        </li>
    <?php endif; ?>
    <?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
        <li>
		<span class="block__icon fa fa-mobile">
		</span>

            <span class="block__content contact-mobile" itemprop="telephone">
			<?php echo $this->contact->mobile; ?>
		</span>
        </li>
    <?php endif; ?>
    <?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
        <li>
		<span class="block__icon fa fa-globe">
		</span>
            <span class="block__content contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
			<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
		</span>
        </li>
    <?php endif; ?>
</ul>

<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php if (JPluginHelper::isEnabled('user', 'profile')) :
	$fields = $this->item->profile->getFieldset('profile'); ?>
	<div class="contact-profile mt-15" id="users-profile-custom">
		<ul class="dl-horizontal">
			<?php foreach ($fields as $profile) :
				if ($profile->value) :
					echo '<li>' . $profile->label;
					$profile->text = htmlspecialchars($profile->value, ENT_COMPAT, 'UTF-8');

					switch ($profile->id) :
						case 'profile_website':
							$v_http = substr($profile->value, 0, 4);

							if ($v_http === 'http') :
								echo '<span><a href="' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></span>';
							else :
								echo '<span><a href="http://' . $profile->text . '">' . JStringPunycode::urlToUTF8($profile->text) . '</a></span>';
							endif;
							break;

						case 'profile_dob':
							echo '<span>' . JHtml::_('date', $profile->text, JText::_('DATE_FORMAT_LC4'), false) . '</span>';
						break;

						default:
							echo '<span>' . $profile->text . '</span>';
							break;
					endswitch;
					echo  '</li>';
				endif;
			endforeach; ?>
		</ul>
	</div>
<?php endif; ?>

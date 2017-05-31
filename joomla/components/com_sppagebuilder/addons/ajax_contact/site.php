<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonAjax_contact extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		// Addon options
		$recipient_email = (isset($this->addon->settings->recipient_email) && $this->addon->settings->recipient_email) ? $this->addon->settings->recipient_email : '';
		$from_email = (isset($this->addon->settings->from_email) && $this->addon->settings->from_email) ? $this->addon->settings->from_email : '';
		$from_name = (isset($this->addon->settings->from_name) && $this->addon->settings->from_name) ? $this->addon->settings->from_name : '';
		$formcaptcha = (isset($this->addon->settings->formcaptcha) && $this->addon->settings->formcaptcha) ? $this->addon->settings->formcaptcha : '';
		$captcha_type = (isset($this->addon->settings->captcha_type)) ? $this->addon->settings->captcha_type : 'default';
		$captcha_question = (isset($this->addon->settings->captcha_question) && $this->addon->settings->captcha_question) ? $this->addon->settings->captcha_question : '';
		$captcha_answer = (isset($this->addon->settings->captcha_answer) && $this->addon->settings->captcha_answer) ? $this->addon->settings->captcha_answer : '';
		$button_text = JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SEND');
		$use_custom_button = (isset($this->addon->settings->use_custom_button) && $this->addon->settings->use_custom_button) ? $this->addon->settings->use_custom_button : 0;
		$button_class = (isset($this->addon->settings->button_type) && $this->addon->settings->button_type) ? ' sppb-btn-' . $this->addon->settings->button_type : ' sppb-btn-success';

		if($use_custom_button) {
			$button_text = (isset($this->addon->settings->button_text) && $this->addon->settings->button_text) ? $this->addon->settings->button_text : JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SEND');
			$button_class .= (isset($this->addon->settings->button_size) && $this->addon->settings->button_size) ? ' sppb-btn-' . $this->addon->settings->button_size : '';
			$button_class .= (isset($this->addon->settings->button_shape) && $this->addon->settings->button_shape) ? ' sppb-btn-' . $this->addon->settings->button_shape: ' sppb-btn-rounded';
			$button_class .= (isset($this->addon->settings->button_appearance) && $this->addon->settings->button_appearance) ? ' sppb-btn-' . $this->addon->settings->button_appearance : '';
			$button_class .= (isset($this->addon->settings->button_block) && $this->addon->settings->button_block) ? ' ' . $this->addon->settings->button_block : '';
			$button_icon = (isset($this->addon->settings->button_icon) && $this->addon->settings->button_icon) ? $this->addon->settings->button_icon : '';
			$button_icon_position = (isset($this->addon->settings->button_icon_position) && $this->addon->settings->button_icon_position) ? $this->addon->settings->button_icon_position: 'left';

			if($button_icon_position == 'left') {
				$button_text = ($button_icon) ? '<i class="fa ' . $button_icon . '"></i> ' . $button_text : $button_text;
			} else {
				$button_text = ($button_icon) ? $button_text . ' <i class="fa ' . $button_icon . '"></i>' : $button_text;
			}
		}

		$output  = '<div class="sppb-addon sppb-addon-ajax-contact ' . $class . '">';

		if($title) {
			$output .= '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-ajax-contact-content">';
		$output .= '<form class="sppb-ajaxt-contact-form">';

		$output .= '<div class="sppb-form-group">';
		$output .= '<input type="text" name="name" class="sppb-form-control" placeholder="'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_NAME') .'" required="required">';
		$output .= '</div>';

		$output .= '<div class="sppb-form-group">';
		$output .= '<input type="email" name="email" class="sppb-form-control" placeholder="'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_EMAIL') .'" required="required">';
		$output .= '</div>';

		$output .= '<div class="sppb-form-group">';
		$output .= '<input type="text" name="subject" class="sppb-form-control" placeholder="'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUBJECT') .'" required="required">';
		$output .= '</div>';

		if($formcaptcha && $captcha_type == 'default') {
			$output .= '<div class="sppb-form-group">';
			$output .= '<input type="text" name="captcha_question" class="sppb-form-control" placeholder="'. $captcha_question .'" required="required">';
			$output .= '</div>';
		}

		$output .= '<div class="sppb-form-group">';
		$output .= '<textarea name="message" rows="5" class="sppb-form-control" placeholder="'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_MESSAGE') .'" required="required"></textarea>';
		$output .= '</div>';

		$output .= '<input type="hidden" name="recipient" value="'. base64_encode($recipient_email) .'">';
		$output .= '<input type="hidden" name="from_email" value="'. base64_encode($from_email) .'">';
		$output .= '<input type="hidden" name="from_name" value="'. base64_encode($from_name) .'">';

		if($formcaptcha && $captcha_type == 'default') {
			$output .= '<input type="hidden" name="captcha_answer" value="'. md5($captcha_answer) .'">';
		} elseif($formcaptcha && $captcha_type == 'gcaptcha'){
			JPluginHelper::importPlugin('captcha', 'recaptcha');
			$dispatcher = JDispatcher::getInstance();
			$dispatcher->trigger('onInit', 'dynamic_recaptcha_' . $this->addon->id);
			$recaptcha = $dispatcher->trigger('onDisplay', array(null, 'dynamic_recaptcha_' . $this->addon->id, 'class="sppb-dynamic-recaptcha"'));

			$output .= (isset($recaptcha[0])) ? $recaptcha[0] : '<p class="sppb-text-danger">'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_CAPTCHA_NOT_INSTALLED') . '</p>';
		}

		$output .= '<input type="hidden" name="captcha_type" value="'. $captcha_type .'">';
		$output .= '<button type="submit" id="btn-' . $this->addon->id . '" class="sppb-btn' . $button_class . '"><i class="fa"></i> '. $button_text .'</button>';

		$output .= '</form>';

		$output .= '<div style="display:none;margin-top:10px;" class="sppb-ajax-contact-status"></div>';

		$output .= '</div>';

		$output .= '</div>';

		return $output;
	}


	public static function getAjax() {

		$input = JFactory::getApplication()->input;
		$mail = JFactory::getMailer();

		$showcaptcha = false;

		//inputs
		$inputs = $input->get('data', array(), 'ARRAY');

		foreach ($inputs as $input) {

			if( $input['name'] == 'captcha_type' ) {
				$captcha_type 	= $input['value'];
			}

			if( $input['name'] == 'recipient' ) {
				$recipient 			= base64_decode($input['value']);
			}

			if( $input['name'] == 'from_email' ) {
				$from_email 			= base64_decode($input['value']);
			}

			if( $input['name'] == 'from_name' ) {
				$from_name 			= base64_decode($input['value']);
			}

			if( $input['name'] == 'email' ) {
				$email 		= $input['value'];
			}

			if( $input['name'] == 'name' ) {
				$name 			= $input['value'];
			}

			if( $input['name'] == 'subject' ) {
				$subject 			= $input['value'];
			}

			if( $input['name'] == 'message' ) {
				$message 			= nl2br( $input['value'] );
			}

			if($input['name'] == 'captcha_question' ) {
				$captcha_question 	= $input['value'];
			}

			if($input['name'] == 'captcha_answer' ) {
				$captcha_answer 	= $input['value'];
				$showcaptcha		= true;
			}

			if($input['name'] == 'g-recaptcha-response' ) {
				$gcaptcha 			= $input['value'];
				$showcaptcha		= true;
			}

		}

		$output = array();
		$output['status'] = false;

		if($showcaptcha) {
			if($captcha_type =='gcaptcha') {
				JPluginHelper::importPlugin('captcha');
				$dispatcher = JEventDispatcher::getInstance();
				$res = $dispatcher->trigger('onCheckAnswer');
				if(!$res[0]) {
					$output['content'] = '<span class="sppb-text-danger">'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_INVALID_CAPTCHA') .'</span>';
					return json_encode($output);
				}
			} else {
				if (md5($captcha_question) != $captcha_answer) {
					$output['content'] = '<span class="sppb-text-danger">'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_WRONG_CAPTCHA') .'</span>';
					return json_encode($output);
				}
			}
		}

		$sender = array($email, $name);

		if (!empty($from_email)) {
			$sender = array($from_email, $from_name);
			$mail->addReplyTo($email, $name);
		}
		
		$mail->setSender($sender);
		$mail->addRecipient($recipient);
		$mail->setSubject($subject);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';
		$mail->setBody($message);

		if ($mail->Send()) {
			$output['status'] = true;
			$output['content'] = '<span class="sppb-text-success">'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_SUCCESS') .'</span>';
		} else {
			$output['content'] = '<span class="sppb-text-danger">'. JText::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_FAILED') .'</span>';
		}

		return json_encode($output);
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);

		$use_custom_button = (isset($this->addon->settings->use_custom_button) && $this->addon->settings->use_custom_button) ? $this->addon->settings->use_custom_button : 0;

		if($use_custom_button) {
			return $css_path->render(array('addon_id' => $addon_id, 'options' => $this->addon->settings, 'id' => 'btn-' . $this->addon->id));
		}
	}
}

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

define('_JEXEC', 1);

if (!isset($_SERVER['HTTP_REFERER'])) die();
$refer = $_SERVER['HTTP_REFERER'];
$url_arr = parse_url($refer);

if (isset($url_arr['port']) && $url_arr['port'] != '80') {
    $check = $url_arr['host'] . ":" . $url_arr['port'];
} else {
    $check = $url_arr['host'];
}
if ($_SERVER['HTTP_HOST'] != $check) die();

define('JPATH_BASE', dirname(__FILE__) . '/../../');
require_once(JPATH_BASE . '/includes/defines.php');
require_once(JPATH_BASE . '/includes/framework.php');


$app = JFactory::getApplication('site');
$lang = JFactory::getLanguage();
$lang->load('mod_tz_contact');
$template = $app->getTemplate(true);
$lang->load('tpl_' . $template->template);
if (JRequest::checkToken()) {
    $post = JRequest::get('post');

    $name = $post['contact_name'];
    $email = $post['contact_email'];
    $email_copy = $post['contact_email_copy'];
    $subject = null;
    if (isset($post['contact_subject'])) {
        $subject = $post['contact_subject'];
    }
    $url=$post['contact_url'];
    $message = $post['contact_message'];
    $id = JRequest::getInt('id');
    JPluginHelper::importPlugin('captcha');
    $dispatcher = JDispatcher::getInstance();
    if (isset($post['recaptcha_response_field'])) {
        $res = $dispatcher->trigger('onCheckAnswer', $post['recaptcha_response_field']);
        if (!$res[0]) {
            echo json_encode(array('fail_captcha' => 0, 'message' => 'Invaild Captcha'));
            die;
        }
    }
    if (!empty($name) && !empty($email) && !empty($message) && !empty($url)) {

        // Get contact information
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__contact_details');
        $query->where('id=' . $id . ' AND published=1');
        $db->setQuery($query);

        $contact = $db->loadObject();

        if (!$subject) {
            $subject = $contact->name;
        }

        $mail = JFactory::getMailer();

        $mail->addRecipient($contact->email_to);
        $mail->setSubject($subject);

        $mail->SetFrom($email);
        $mail->FromName = $name;
        if ($email_copy == '1') {
            $mail->addBCC($email);
        }

        $body = '<p>'.$message.'</p><p>'.JText::_('MOD_TZ_CONTACT_MAIL_URL_LABEL').$url.'</p>';
        $mail->isHTML(true);
        $mail->setBody($body);

        $sent = $mail->Send();

        if (!($sent instanceof Exception)) {
            echo json_encode(array('success' => 1));
            die();
        } else {
            echo json_encode(array('success' => 0, 'message' => ($sent->getMessage())));
            die();
        }
    } else {
        echo json_encode(array('success' => 0, 'message' => base64_decode($post['error'])));
        die();
    }
} else {
    echo json_encode(array('success' => 0, 'message' => JText::_('JINVALID_TOKEN')));
    die();
}
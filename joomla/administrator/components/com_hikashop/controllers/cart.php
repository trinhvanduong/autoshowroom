<?php
/**
 * @package	HikaShop for Joomla!
 * @version	3.0.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2017 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
class CartController extends hikashopController {
	public $type = 'cart';
	public $pkey = array('cart_id');
	public $table = array('cart');
	public $orderingMap = 'cart_modified';

	public function __construct($config = array(), $skip = false) {
		parent::__construct($config, $skip);

		$this->display[] = 'showblock';
		$this->modify[] = 'addproduct';
	}

	public function edit() {
		$app = JFactory::getApplication();
		$cid = hikashop_getCID('cart_id');
		if(empty($cid)) {
			$app->enqueueMessage(JText::_('INVALID_CART'), 'error');
			$app->redirect( hikashop_completeLink('cart&task=listing', false, true) );
		}

		$cartClass = hikashop_get('class.cart');
		$cart = $cartClass->get( $cid );
		if(empty($cart)) {
			$app->enqueueMessage(JText::_('INVALID_CART'), 'error');
			$app->redirect( hikashop_completeLink('cart&task=listing', false, true) );
		}

		return parent::edit();
	}

	public function showblock() {
		hikashop_nocache();
		$cart_id = hikashop_getCID('cart_id');
		if(empty($cart_id))
			return false;

		$tmpl = JRequest::getCmd('tmpl', '');
		JRequest::setVar('layout', 'showblock');
		if($tmpl == 'component' || $tmpl == 'ajax') {
			ob_end_clean();
			parent::display();
			exit;
		}
		return $this->display();
	}

	public function addproduct() {
		hikashop_nocache();

		JRequest::checkToken('request') || jexit('Invalid Token');

		$cart_id = hikashop_getCID('cart_id');
		$product_id = JRequest::getInt('product_id', 0);
		if(empty($cart_id) || empty($product_id))
			return false;

		$cartClass = hikashop_get('class.cart');
		$cart = $cartClass->get( $cart_id );
		if(empty($cart))
			return false;

		$db = JFactory::getDBO();
		$values = array(
			'cart_id' => $cart_id,
			'product_id' => $product_id,
			'cart_product_quantity' => 1,
			'cart_product_parent_id' => 0,
			'cart_product_modified' => time(),
			'cart_product_option_parent_id' => 0
		);
		$query = 'INSERT INTO '.hikashop_table('cart_product').' ('.implode(',', array_keys($values)).') VALUES ('.implode(',', $values).')';
		$db->setQuery($query);
		$ret = (int)$db->query();
		if(!$ret)
			return false;

		$cart_product_id = (int)$db->insertid();

		$cartClass->get('reset_cache', $cart_id);

		JRequest::setVar('layout', 'showblock');
		JRequest::setVar('block', 'product');
		JRequest::setVar('pid', $cart_product_id);

		$tmpl = JRequest::getCmd('tmpl', '');
		if($tmpl == 'component' || $tmpl == 'ajax') {
			ob_end_clean();
			parent::display();
			exit;
		}
		return $this->display();
	}
}

<?php
/**
 * @package	HikaShop for Joomla!
 * @version	3.0.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2017 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><div class="header hikashop_header_title"><h1><?php
	if($this->cart->cart_type == 'wishlist') {
		if(empty($this->manage) && !empty($this->cart->user)) {
			$user = !empty($this->cart->user->username) ? $this->cart->user->username : $this->cart->user->user_email;
			echo JText::sprintf('HIKASHOP_USER_WISHLIST', $user);
		} else
			echo JText::_('HIKASHOP_WISHLIST');
	} else
		echo JText::_('HIKASHOP_CART');
?></h1></div>

<?php if(empty($this->print_cart)) { ?>
<form method="POST" id="hikashop_show_cart_form" name="hikashop_show_cart_form" action="<?php echo hikashop_completeLink('cart&task=show&cid='.(int)$this->cart->cart_id); ?>">

<div class="toolbar hikashop_header_buttons" id="toolbar" style="float: right;">
	<table class="hikashop_no_border">
		<tr>
<?php
	if($this->config->get('print_cart')) {
?>
			<td><?php
				echo $this->popupHelper->display(
					'<span class="icon-32-print" title="'. JText::_('HIKA_PRINT').'"></span>'. JText::_('HIKA_PRINT'),
					'HIKA_PRINT',
					hikashop_completeLink('cart&task=show&cart_id='.$this->cart->cart_id, true),
					'hikashop_print_cart',
					760, 480, '', '', 'link'
				);
			?></td>
<?php
	}
?>
<?php
	if($this->config->get('enable_multicart')) {
?>
			<td><?php
		$dropData = array();
		foreach($this->user_carts as $user_cart) {
			$cart_name = !empty($user_cart->cart_name) ? $user_cart->cart_name : '';
			if(empty($cart_name))
				$cart_name = !empty($user_cart->cart_current) ? JText::_('CURRENT_CART') : hikashop_getDate($user_cart->cart_modified);
			$dropData[] = array(
				'name' => $cart_name,
				'link' => '#move-to-cart',
				'click' => 'return window.cartMgr.moveProductsToCart('.(int)$user_cart->cart_id.');'
			);
		}

		if(!empty($dropData))
			$dropData[] = '-';

		$dropData[] = array(
			'name' => JText::_('NEW_CART'),
			'link' => '#new-cart',
			'click' => 'return window.cartMgr.moveProductsToCart(-1);'
		);

		echo $this->dropdownHelper->display(
			!empty($this->manage) ? JText::_('MOVE_TO_CART') : JText::_('ADD_TO_CART'),
			$dropData,
			array('type' => 'link', 'right' => true, 'up' => false, 'hkicon' => 'icon-32-cart')
		);
			?></td>
<?php
	} elseif($this->cart->cart_type == 'wishlist') {
?>
			<td>
				<a href="#" onclick="return window.cartMgr.moveProductsToCart(0);">
					<span class="icon-32-cart" title="<?php echo JText::_('ADD_TO_CART'); ?>"></span> <?php echo JText::_('ADD_TO_CART'); ?>
				</a>
			</td>
<?php
	}
?>
<?php
	if($this->config->get('enable_wishlist')) {
?>
			<td><?php
		$dropData = array();
		foreach($this->user_wishlists as $user_wishlist) {
			$dropData[] = array(
				'name' => !empty($user_wishlist->cart_name) ? $user_wishlist->cart_name : hikashop_getDate($user_wishlist->cart_modified),
				'link' => '#move-to-wishlist',
				'click' => 'return window.cartMgr.moveProductsToWishlist('.(int)$user_wishlist->cart_id.');'
			);
		}

		if(!empty($dropData))
			$dropData[] = '-';

		$dropData[] = array(
			'name' => JText::_('NEW_WISHLIST'),
			'link' => '#new-wishlist',
			'click' => 'return window.cartMgr.moveProductsToWishlist(-1);'
		);

		echo $this->dropdownHelper->display(
			!empty($this->manage) ? JText::_('MOVE_TO_WISHLIST') : JText::_('ADD_TO_WISHLIST'),
			$dropData,
			array('type' => 'link', 'right' => true, 'up' => false, 'hkicon' => 'icon-32-wishlist')
		);
			?></td>
<?php
	}
?>
<?php
	if(!empty($this->manage)) {
?>
			<td>
				<a href="#" onclick="return window.hikashop.submitform('apply','hikashop_show_cart_form');">
					<span class="icon-32-save" title="<?php echo JText::_('HIKA_SAVE'); ?>"></span> <?php echo JText::_('HIKA_SAVE'); ?>
				</a>
			</td>
<?php
	}
	$link = hikashop_completeLink('user&task=cpanel');
	if($this->config->get('enable_multicart')) {
		$link = hikashop_completeLink('cart&task=listing&cart_type=' . $this->cart->cart_type);
	}
?>
			<td>
				<a href="<?php echo $link; ?>">
					<span class="icon-32-back" title="<?php echo JText::_('HIKA_BACK'); ?>"></span> <?php echo JText::_('HIKA_BACK'); ?>
				</a>
			</td>
		</tr>
	</table>
</div>
<?php } ?>
<div style="clear:both"></div>
<?php
	if(!empty($this->manage) && $this->cart->cart_type != 'wishlist' && $this->config->get('enable_multicart') && !empty($this->user_carts)) {
?>
<dl class="hika_options">
	<dt><label for="cart_name"><?php echo JText::_('HIKASHOP_CART_NAME'); ?></label></dt>
	<dd>
		<input type="text" id="cart_name" name="data[cart_name]" class="inputbox" value="<?php echo $this->escape($this->cart->cart_name); ?>"/>
	</dd>
</dl>
<?php
	}
?>
<?php
	if($this->cart->cart_type == 'wishlist') {
		if(!empty($this->manage)) {
?>
<dl class="hika_options">
	<dt><label for="cart_name"><?php echo JText::_('HIKASHOP_WISHLIST_NAME'); ?></label></dt>
	<dd>
		<input type="text" id="cart_name" name="data[cart_name]" class="inputbox" value="<?php echo $this->escape($this->cart->cart_name); ?>"/>
	</dd>
	<dt><label for="cart_share"><?php echo JText::_('SHARE'); ?></label></dt>
	<dd><?php
		echo $this->cartShareType->display('data[cart_share]', $this->cart->cart_share);
	?></dd>
<?php if($this->cart->cart_share != 'nobody') { ?>
	<dt><label for="cart_share"><?php echo JText::_('HIKASHOP_WISHLIST_LINK'); ?></label></dt>
	<dd>
		<input onfocus="this.select();" style="width:100%;" readonly="readonly" type="text" value="<?php echo $this->cart_share_url; ?>"/>
	</dd>
<?php } ?>
</dl>
<?php
		} else {
?>
<dl class="hika_options">
	<dt><label><?php echo JText::_('HIKASHOP_WISHLIST_NAME'); ?></label></dt>
	<dd><?php
		if(!empty($this->cart->cart_name))
			echo $this->escape($this->cart->cart_name);
		else
			echo '<em>'.JText::_('HIKA_NO_NAME').'</em>';
	?></dd>
</dl>
<?php
		}
	}
?>
<table id="hikashop_cart_product_listing" class="hikashop_cart_products adminlist table table-striped table-hover" style="width:100%">
	<thead>
		<tr>
<?php if($this->checkbox_column) { ?>
			<th style="width:1%"><input type="checkbox" onchange="window.hikashop.checkAll(this);" /></th>
<?php } ?>
			<th class="hikashop_cart_name_title title"><?php
				echo JText::_('CART_PRODUCT_NAME');
			?></th>
<?php
	if(hikashop_level(2) && !empty($this->productFields)) {
		foreach($this->productFields as $field) {
			echo '<th class="hikashop_cart_product_'.$fieldname.'">'.$this->fieldsClass->getFieldName($field).'</th>';
		}
	}
?>
			<th class="hikashop_cart_status_title title"><?php
				echo JText::_('HIKASHOP_CHECKOUT_STATUS');
			?></th>
			<th class="hikashop_cart_price_title title"><?php
				echo JText::_('CART_PRODUCT_UNIT_PRICE');
			?></th>
			<th class="hikashop_cart_quantity_title title"><?php
				echo JText::_('PRODUCT_QUANTITY');
			?></th>
			<th class="hikashop_cart_price_title title"><?php
				echo JText::_('CART_PRODUCT_TOTAL_PRICE');
			?></th>
		</tr>
	</thead>
<?php
	$cols = 5 + ($this->checkbox_column ? 1 : 0) + (hikashop_level(2) ? count($this->productFields) : 0);
?>
	<tfoot>
		<tr>
			<td class="hika_show_cart_total_text" colspan="<?php echo $cols - 2; ?>"><?php
				echo JText::_('HIKASHOP_TOTAL');
			?></td>
			<td class="hika_show_cart_total_quantity"><?php
				echo (int)@$this->cart->package['total_items'];
			?></td>
			<td class="hika_show_cart_total_price"><?php
	if(!empty($this->cart->total->prices)) {
		if($this->config->get('price_with_tax')) {
			echo $this->currencyClass->format($this->cart->total->prices[0]->price_value_with_tax, $this->cart->total->prices[0]->price_currency_id);
		}
		if($this->config->get('price_with_tax') == 2) {
			echo JText::_('PRICE_BEFORE_TAX');
		}
		if($this->config->get('price_with_tax') == 2 || !$this->config->get('price_with_tax')) {
			echo $this->currencyClass->format($this->cart->total->prices[0]->price_value, $this->cart->total->prices[0]->price_currency_id);
		}
		if($this->config->get('price_with_tax') == 2) {
			echo JText::_('PRICE_AFTER_TAX');
		}
	}
			?></td>
		</tr>
	</tfoot>
	<tbody>
<?php
	$group = $this->config->get('group_options', 0);
	$width = (int)$this->config->get('cart_thumbnail_x', 50);
	$height = (int)$this->config->get('cart_thumbnail_y', 50);
	$image_options = array(
		'default' => true,
		'forcesize' => $this->config->get('image_force_size', true),
		'scale' => $this->config->get('image_scale_mode','inside')
	);

	$i = 1;
	$k = 1;
	foreach($this->cart->products as $k => $product) {
		if($group && !empty($product->cart_product_option_parent_id))
			continue;
		if(empty($product->cart_product_quantity) || substr($k,0,1) === 'p')
			continue;

		if(empty($this->cart->cart_products[$k]))
			continue;

		$cart_product = $this->cart->cart_products[$k];

?>
		<tr class="row<?php echo $k; ?>">
<?php
		if($this->checkbox_column) {
?>
			<td><input type="checkbox" name="products[]" value="<?php echo (int)$k; ?>" id="cb<?php echo $k; ?>"/></td>
<?php
		}
?>
			<td><?php
		$image_path = (!empty($product->images) ? @$product->images[0]->file_path : '');
		$img = $this->imageHelper->getThumbnail($image_path, array('width' => $width, 'height' => $height), $image_options);
		if($img->success) {
			echo '<img class="hikashop_cart_product_image" title="'.$this->escape(@$product->images[0]->file_description).'" alt="'.$this->escape(@$product->images[0]->file_name).'" src="'.$img->url.'" style="float:left; margin-right:3px;" />';
		}

?>
				<span class="hikashop_cart_product_name">
					<a href="<?php echo hikashop_contentLink('product&task=show&cid='.$product->product_id.'&name='.$product->alias, $product); ?>"><?php
						echo $product->product_name;
					?></a>
				</span>
<?php

		if($this->config->get('show_code')) {
			echo '<br/>' . '<span class="hikashop_cart_product_code">'.$product->product_code.'</span>';
		}

		if($group) {
			foreach($this->cart->products as $opt_k => $opt_product) {
				if($opt_product->cart_product_option_parent_id != $product->cart_product_id)
					continue;
?>
				<p class="hikashop_cart_option_name"><?php
					echo $opt_product->product_name;
				?></p>
<?php
				if(!empty($opt_product->prices[0])) {
					if(!isset($product->prices[0])) {
						$product->prices[0] = new stdClass();
						$product->prices[0]->price_value = 0;
						$product->prices[0]->price_value_with_tax = 0;
						$product->prices[0]->price_currency_id = !empty($this->cart->cart_currency_id) ? (int)$this->cart->cart_currency_id : hikashop_getCurrency();
					}

					foreach(get_object_vars($product->prices[0]) as $key => $value) {
						if(is_object($value)) {
							foreach(get_object_vars($value) as $key2 => $var2) {
								if(strpos($key2,'price_value') !== false)
									$product->prices[0]->$key->$key2 += @$opt_product->prices[0]->$key->$key2;
							}
						} else {
							if(strpos($key,'price_value') !== false)
								$product->prices[0]->$key += @$opt_product->prices[0]->$key;
						}
					}
				}
			}
		}

		if(hikashop_level(2) && !empty($this->itemFields)) {
?>
				<p class="hikashop_order_product_custom_item_fields">
<?php
			foreach($this->itemFields as $field) {
				$namekey = $field->field_namekey;
				if(!empty($cart_product->$namekey) && strlen($cart_product->$namekey)) {
					echo '<p class="hikashop_order_item_'.$namekey.'">' .
						$this->fieldsClass->getFieldName($field) . ': ' .
						$this->fieldsClass->show($field, $cart_product->$namekey) .
						'</p>';
				}
			}
?>
				</p>
<?php
		}

			?></td>
<?php
	if(hikashop_level(2) && !empty($this->productFields)) {
		foreach($this->productFields as $field) {
			$namekey = $field->field_namekey;
?>
			<td><?php
			if(!empty($product->$namekey))
				echo '<p class="hikashop_order_product_'.$namekey.'">' . $this->fieldsClass->show($field, $product->$namekey) . '</p>';
			?></td>
<?php
		}
	}
?>
			<td style="text-align:center"><?php
	$tooltip_images = array(
		'ok' => '<img src="'.HIKASHOP_IMAGES.'icons/icon-16-publish.png" alt="'.JText::_('PRODUCT_AVAILABLE').'"/>',
		'err' => '<img src="'.HIKASHOP_IMAGES.'icons/icon-16-unpublish.png" alt="'.JText::_('PRODUCT_UNAVAILABLE').'"/>'
	);
	if (empty($product) || (!empty($product->product_sale_end) && $product->product_sale_end < time())) {
		echo hikashop_hktooltip(JText::_('HIKA_NOT_SALE_ANYMORE'), '', $tooltip_images['err']);
	} elseif ($product->product_quantity == -1) {
		echo hikashop_hktooltip(JText::sprintf('X_ITEMS_IN_STOCK', JText::_('HIKA_UNLIMITED')), '', $tooltip_images['ok']);
	} elseif (($product->product_quantity - $product->cart_product_quantity) >= 0) {
		echo hikashop_hktooltip(JText::sprintf('X_ITEMS_IN_STOCK', $product->product_quantity), '', $tooltip_images['ok']);
	} else {
		echo hikashop_hktooltip(JText::_('NOT_ENOUGH_STOCK'), '', $tooltip_images['err']);
	}
			?></td>
			<td><?php
	$this->setLayout('listing_price');
	$this->row =& $product;
	$this->unit = true;
	echo $this->loadTemplate();
			?></td>
			<td>
<?php
	if(!empty($this->manage)) {
		if($this->cart->cart_type == 'wishlist') {
			$this->row->product_min_per_order = 1;
			$this->row->product_max_per_order = 0;
		}
		echo $this->loadHkLayout('quantity', array(
			'quantity_fieldname' => 'data[products]['.$product->cart_product_id.'][quantity]',
			'onchange_script' => 'window.cartMgr.checkQuantity(this);',
			'extra_data' => 'data-hk-product-name="'.$this->escape($product->product_name).'"',
		));
	} else {
?>
				<div class="hikashop_product_quantity_div hikashop_product_quantity_input_div_none">
					<span><?php echo $product->cart_product_quantity; ?></span>
				</div>
<?php
	}
?>
<?php
	if(!empty($this->manage)) {
?>
				<a class="hikashop_no_print" href="#delete" onclick="var qtyField = document.getElementById('<?php echo $this->last_quantity_field_id; ?>'); if(!qtyField) return false; qtyField.value = 0; return window.hikashop.submitform('apply','hikashop_show_cart_form');" title="<?php echo JText::_('HIKA_DELETE'); ?>">
					<img src="<?php echo HIKASHOP_IMAGES . 'delete2.png';?>" border="0" alt="<?php echo JText::_('HIKA_DELETE'); ?>" />
				</a>
<?php
	}

	if(!empty($product->bought)) {
?>
				<div class="hikashop_wishlist_product_bought">
					<span><?php
		$desc = '';
		if($this->manage) {
			$buyers = array();
			foreach($product->related_orders as $related_order) {
				if(empty($buyers[(int)$related_order->order_user_id]))
					$buyers[(int)$related_order->order_user_id] = array($related_order->user_email, 0);
				$buyers[(int)$related_order->order_user_id][1] += (int)$related_order->order_product_quantity;
			}
			foreach($buyers as $buyer) {
				$desc .= $buyer[0] . ' ('.$buyer[1].')';
			}
		}

		if(!empty($desc)) {
			echo hikashop_hktooltip($desc, '', JText::sprintf('HIKA_BOUGHT_X_TIMES', (int)$product->bought));
		} else {
			echo JText::sprintf('HIKA_BOUGHT_X_TIMES', (int)$product->bought);
		}
					?></span>
				</div>
<?php
	}
?>
			</td>
			<td><?php
	$this->setLayout('listing_price');
	$this->row =& $product;
	$this->unit = false;
	echo $this->loadTemplate();
			?></td>
		</tr>
<?php
		$k = 1 - $k;
		$i++;
	}
?>
	</tbody>
</table>
<?php if(empty($this->print_cart)) { ?>
	<input type="hidden" name="option" value="<?php echo HIKASHOP_COMPONENT; ?>" />
	<input type="hidden" name="ctrl" value="cart"/>
	<input type="hidden" name="task" value="show"/>
	<input type="hidden" name="cid" value="<?php echo (int)$this->cart->cart_id; ?>"/>
	<input type="hidden" name="addto_type" value=""/>
	<input type="hidden" name="addto_id" value=""/>
	<?php echo JHTML::_('form.token'); ?>
</form>
<script type="text/javascript">
window.hikashop.ready(function(){
	setTimeout(function(){window.hikashop.dlTitle('hikashop_show_cart_form')},1000);
});
if(!window.cartMgr) window.cartMgr = {};
window.cartMgr.moveProductsTo = function(id, type) {
	var d = document, form = d.getElementById('hikashop_show_cart_form');
	if(!form)
		form = d.forms['hikashop_show_cart_form'];
	if(!form)
		return false;
	form.task.value = 'addtocart';
	form.addto_type.value = type;
	form.addto_id.value = parseInt(id);
	if(typeof form.onsubmit == 'function')
		form.onsubmit();
	form.submit();
	return false;
};
window.cartMgr.checkQuantity = function(el) {
	var value = parseInt(el.value),
		min = parseInt(el.getAttribute('data-hk-qty-min')),
		max = parseInt(el.getAttribute('data-hk-qty-max'));
	if(isNaN(value)) {
		el.value = isNaN(min) ? 1 : min;
		return false;
	}
	if(isNaN(min) || isNaN(max))
		return false;
	if((value <= max || max == 0) && value >= min)
		return true;

	if(max > 0 && value > max) {
		msg = '<?php echo JText::_('TOO_MUCH_QTY_FOR_PRODUCT', true); ?>';
		el.value = max;
	} else if(value < min) {
		msg = '<?php echo JText::_('NOT_ENOUGH_QTY_FOR_PRODUCT', true); ?>';
		el.value = min;
	}
	name = el.getAttribute('data-hk-product-name');
	if(msg && name)
		alert(msg.replace('%s', name));
	return true;
};
window.cartMgr.moveProductsToCart = function(id) { return window.cartMgr.moveProductsTo(id, 'cart'); };
window.cartMgr.moveProductsToWishlist = function(id) { return window.cartMgr.moveProductsTo(id, 'wishlist'); };
</script>
<?php } ?>

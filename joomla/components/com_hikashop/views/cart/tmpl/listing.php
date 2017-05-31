<?php
/**
 * @package	HikaShop for Joomla!
 * @version	3.0.1
 * @author	hikashop.com
 * @copyright	(C) 2010-2017 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><div id="hikashop_carts_listing">

<div class="header hikashop_header_title"><h1><?php
	if($this->cart_type == 'wishlist')
		echo JText::_('WISHLISTS');
	else
		echo JText::_('CARTS');
?></h1></div>

<div class="toolbar hikashop_header_buttons" id="toolbar" style="float: right;">
	<table class="hikashop_no_border">
		<tr>
			<td>
				<a href="<?php echo hikashop_completeLink('user&task=cpanel'); ?>" >
					<span class="icon-32-back" title="<?php echo JText::_('HIKA_BACK'); ?>"></span>
					<?php echo JText::_('HIKA_BACK'); ?>
				</a>
			</td>
		</tr>
	</table>
</div>
<div style="clear:both"></div>

<table id="hikashop_cart_listing" class="hikashop_carts adminlist table table-striped table-hover" style="width:100%">
	<thead>
		<tr>
			<th class="hikashop_cart_name_title title"><?php
				echo JText::_('CART_PRODUCT_NAME');
			?></th>
			<th class="hikashop_cart_quantity_title title"><?php
				echo JText::_('PRODUCT_QUANTITY');
			?></th>
			<th class="hikashop_cart_price_title title"><?php
				echo JText::_('PRODUCT_PRICE');
			?></th>
			<th class="hikashop_cart_modified_title title"><?php
				echo JText::_('HIKA_LAST_MODIFIED');
			?></th>
			<th class="hikashop_cart_current_title title"><?php
				echo JText::_('HIKA_CURRENT');
			?></th>
			<th class="hikashop_cart_delete_title title"><?php
				echo JText::_('HIKA_DELETE');
			?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="6">
<form method="POST" action="<?php echo hikashop_completeLink('cart&task=listing'); ?>">
<?php
	echo $this->pagination->getListFooter();
	echo $this->pagination->getResultsCounter();
?>
<input type="hidden" name="option" value="<?php echo HIKASHOP_COMPONENT; ?>" />
<input type="hidden" name="task" value="listing" />
<input type="hidden" name="ctrl" value="<?php echo JRequest::getCmd('ctrl'); ?>" />
<?php echo JHTML::_('form.token'); ?>
</form>
			</td>
		</tr>
	</tfoot>
	<tbody>
<?php
	$i = 0;
	$k = 0;
	foreach($this->carts as $cart) {
?>
		<tr class="row<?php echo $k; ?>">
			<td class="hikashop_cart_name_value">
				<a href="<?php echo hikashop_completeLink('cart&task=show&cid='.(int)$cart->cart_id);?>">
					<img src="<?php echo HIKASHOP_IMAGES; ?>edit.png" alt="" style="margin-right:3px;"/><?php
					if(!empty($cart->cart_name))
						echo $this->escape($cart->cart_name);
					else
						echo '<em>'.JText::_('HIKA_NO_NAME').'</em>';
				?></a>
			</td>
			<td class="hikashop_cart_quantity_value"><?php
				echo (int)@$cart->package['total_quantity'];
			?></td>
			<td class="hikashop_cart_price_value"><?php
				echo $this->currencyClass->format(@$cart->total->prices[0]->price_value_with_tax, $cart->cart_currency_id);
			?></td>
			<td class="hikashop_cart_modified_value"><?php
				echo hikashop_getDate($cart->cart_modified);
			?></td>
			<td class="hikashop_cart_current_value"><?php
				if($cart->cart_current) {
					?><img src="<?php echo HIKASHOP_IMAGES; ?>star-on.png" alt="<?php echo JText::_('HIKA_CURRENT'); ?>"/><?php
				} else {
?>
				<a href="<?php echo hikashop_completeLink('cart&task=setcurrent&cid='.(int)$cart->cart_id.'&'.hikashop_getFormToken().'=1');?>">
					<img src="<?php echo HIKASHOP_IMAGES; ?>star-off.png" alt="<?php echo JText::_('HIKA_SET_AS_CURRENT'); ?>"/>
				</a>
<?php
				}
			?></td>
			<td class="hikashop_cart_delete_value">
				<a href="<?php echo hikashop_completeLink('cart&task=remove&cid='.(int)$cart->cart_id.'&'.hikashop_getFormToken().'=1'); ?>" onclick="if(window.localPage && window.localPage.confirmDelete) return window.localPage.confirmDelete()">
					<img src="<?php echo HIKASHOP_IMAGES;?>delete2.png" alt="<?php echo JText::_('HIKA_DELETE'); ?>" />
				</a>
			</td>
		</tr>
<?php
		$i++;
		$k = 1 - $k;
	}
?>
	</tbody>
</table>
<script type="text/javascript">
if(!window.localPage)
	window.localPage = {};
window.localPage.confirmDelete = function() {
	return confirm('<?php
		if($this->cart_type == 'wishlist')
			echo JText::_('HIKA_CONFIRM_DELETE_WISHLIST', true);
		else
			echo JText::_('HIKA_CONFIRM_DELETE_CART', true);
	?>');
};
</script>
</div>

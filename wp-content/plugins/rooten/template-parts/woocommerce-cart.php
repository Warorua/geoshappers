<?php if (class_exists('Woocommerce')) { 
	
	$layout_c        = get_theme_mod('rooten_header_layout', 'horizontal-left');
	$layout_m        = get_post_meta( get_the_ID(), 'rooten_header_layout', true );
	$layout          = (!empty($layout_m) and $layout_m != 'default') ? $layout_m : $layout_c;

	$cart = get_theme_mod('rooten_woocommerce_cart');

	if($cart !== 'no') { 
	global $woocommerce; 
	$rooten_wcrtl = (is_rtl()) ? 'left' : 'right';
	$offset = ( $cart == 'toolbar') ? 15 : 32;
	?>
	
	<div class="tm-cart-popup">
		<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" id="shopping-btn" class="tm-shopping-cart" title="<?php esc_html_e('View Cart', 'rooten'); ?>">
			<span bdt-icon="icon: cart"></span>
			<?php
				$product_bumber = $woocommerce->cart->cart_contents_count; 
				if ($cart == 'header') {
					if ( sizeof( $woocommerce->cart->cart_contents ) != 0 ) {
						echo '<span class="pcount">'.esc_html($product_bumber).'</span>';
					} 
				}
				if ($cart == 'toolbar') {
					echo '<div class="bdt-hidden-small bdt-display-inline">';
					if ( sizeof( $woocommerce->cart->cart_contents ) == 0 ) {
						esc_html_e('Cart is Empty', 'rooten');
					} else {
						echo sprintf( _n( '%s Item in cart', '%s Items in cart', $product_bumber, 'rooten' ), $product_bumber );
					}
					echo '</div>';
				} 
			?>
		</a>
		
		<?php if (!in_array($layout, ['side-left', 'side-right'])) : ?>
			<?php if ( sizeof( $woocommerce->cart->cart_contents ) != 0 and !is_checkout() and !is_cart()) : ?>
				<div class="cart-dropdown" bdt-drop="mode: hover; offset: <?php echo esc_attr($offset); ?>">
					<div class="bdt-card bdt-card-body bdt-card-default">
						<?php if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) { the_widget( 'WC_Widget_Cart', '' ); } ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
	<?php }
} ?>
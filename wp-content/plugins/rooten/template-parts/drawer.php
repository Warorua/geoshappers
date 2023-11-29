<?php if (is_active_sidebar('drawer')) : ?>
<?php
	$class             = ['tm-drawer', 'bdt-section'];
	$container_class   = [];
	$grid_class        = ['bdt-grid'];
	$background_style  = get_theme_mod( 'rooten_drawer_bg_style', 'secondary' );
	$width             = get_theme_mod( 'rooten_drawer_width', 'default');
	$padding           = get_theme_mod( 'rooten_drawer_padding', 'small' );
	$text              = get_theme_mod( 'rooten_drawer_txt_style' );
	$breakpoint        = get_theme_mod( 'rooten_bottom_breakpoint', 'm' );

	$class[]           = ($background_style) ? 'bdt-section-'.$background_style : '';
	$class[]           = ($text) ? 'bdt-'.$text : '';
	if ($padding != 'none') {
		$class[]       = ($padding) ? 'bdt-section-'.$padding : '';
	} elseif ($padding == 'none') {
		$class[]       = ($padding) ? 'bdt-padding-remove-vertical' : '';
	}

	$container_class[] = ($width) ? 'bdt-container bdt-container-'.$width : '';
	$grid_class[]      = ($breakpoint) ? 'bdt-child-width-expand@'.$breakpoint : '';
	$wrapper_bg = ($background_style) ? ' bdt-background-'.$background_style : '';
?>

<div class="drawer-wrapper<?php echo esc_url($wrapper_bg); ?>">
	<div id="tm-drawer" <?php echo rooten_helper::attrs(['class' => $class]) ?> hidden>
		<div <?php echo rooten_helper::attrs(['class' => $container_class]) ?>>
			<div <?php echo rooten_helper::attrs(['class' => $grid_class]) ?> bdt-grid>
				<?php dynamic_sidebar('drawer'); ?>
			</div>
		</div>
	</div>
	<a href="javascript:void(0);" class="drawer-toggle bdt-position-top-right bdt-margin-small-right" bdt-toggle="target: #tm-drawer; animation: bdt-animation-slide-top; queued: true"><span bdt-icon="icon: chevron-down"></span></a>
</div>
<?php endif; ?>
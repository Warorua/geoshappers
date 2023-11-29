<?php

/**
 * Admin related stylesheets
 * @return [type] [description]
 */
function rooten_admin_style() {
	wp_register_style( 'admin-setting', get_template_directory_uri() . '/admin/css/admin-settings.css' );
	wp_enqueue_style( 'admin-setting' );
}
add_action( 'admin_enqueue_scripts', 'rooten_admin_style' );


/**
 * Admin related scripts
 * @return [type] [description]
 */
function rooten_admin_script() {
	wp_register_script('admin-setting', get_template_directory_uri() . '/admin/js/admin-settings.js', array( 'jquery' ), ROOTEN_VER, true);

	wp_enqueue_script('admin-setting');
}
add_action( 'admin_enqueue_scripts', 'rooten_admin_script' );


/**
 * Site Stylesheets
 * @return [type] [description]
 */
function rooten_styles() {

	$rtl_enabled = is_rtl();

	// Load Primary Stylesheet
	if (!class_exists('ElementPack\Element_Pack_Loader')) {
		if ($rtl_enabled) {
			wp_enqueue_style( 'theme-style', ROOTEN_URL .'/css/theme.rtl.css', array(), ROOTEN_VER, 'all' );
		} else {
			wp_enqueue_style( 'theme-style', ROOTEN_URL .'/css/theme.css', array(), ROOTEN_VER, 'all' );
		}
	}
	if (class_exists('Woocommerce')) {
		wp_enqueue_style( 'theme-style', ROOTEN_URL .'/css/woocommerce.css', array(), ROOTEN_VER, 'all' );
	}

	if (get_theme_mod( 'rooten_header_txt_style', false )) {
		wp_enqueue_style( 'theme-style', ROOTEN_URL .'/css/inverse.css', array(), ROOTEN_VER, 'all' );
	}

	wp_enqueue_style( 'theme-fonts', rooten_fonts_url(), array(), null );
	wp_enqueue_style( 'rooten-style', get_stylesheet_uri(), array(), ROOTEN_VER, 'all' );

}  
add_action( 'wp_enqueue_scripts', 'rooten_styles' );


function rooten_fonts_url() {
	$fonts_url = '';

	
	$theme_font = _x( 'on', 'Libre Franklin font: on or off', 'rooten' );

	if ( 'off' !== $theme_font ) {
		$font_families = array();

		$font_families[] = 'Roboto:300,300i,400,400i,700';
		$font_families[] = 'Open Sans:300,300i,400,400i,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Site Scripts
 * @return [type] [description]
 */
function rooten_scripts() {

	$suffix    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	$preloader = get_theme_mod('rooten_preloader');

	if ($preloader) {
		wp_enqueue_script('please-wait', ROOTEN_URL . '/js/please-wait.min.js', array(), ROOTEN_VER, false);
	}
	// wp_dequeue_script('bdt-uikit');
	if (!class_exists('ElementPack\Element_Pack_Loader')) {
		wp_register_script( 'bdt-uikit', ROOTEN_URL . '/js/bdt-uikit' . $suffix . '.js', ['jquery'], '3.0.0.42', true );
		wp_register_script( 'bdt-uikit-icons', ROOTEN_URL . '/js/bdt-uikit-icons' . $suffix . '.js', ['jquery', 'bdt-uikit'], '3.0.0.42', true );

	} else {
		wp_register_script( 'bdt-uikit', WP_PLUGIN_URL . '/bdthemes-element-pack/assets/js/bdt-uikit' . $suffix . '.js', ['jquery'], '3.0.0.42', true );
		wp_register_script( 'bdt-uikit-icons', WP_PLUGIN_URL . '/bdthemes-element-pack/assets/js/bdt-uikit-icons' . $suffix . '.js', ['jquery', 'bdt-uikit'], '3.0.0.42', true );
		
	}

	wp_enqueue_script('bdt-uikit');
	wp_enqueue_script('bdt-uikit-icons');

	wp_register_script('cookie-bar', ROOTEN_URL . '/js/jquery.cookiebar.js', array( 'jquery' ), ROOTEN_VER, true);
	wp_register_script('rooten-script', ROOTEN_URL . '/js/theme.js', array( 'jquery' ), ROOTEN_VER, true);
	// Enqueue
	wp_enqueue_script('cookie-bar');
	wp_enqueue_script('rooten-script');

  	// Load WP Comment Reply JS
  	if(is_singular()) { wp_enqueue_script( 'comment-reply' ); }
}

add_action( 'wp_enqueue_scripts', 'rooten_scripts' );  
<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'rooten_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function rooten_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'               => esc_html_x('BdThemes FAQ', 'backend', 'rooten'),
            'slug'               => 'bdthemes-faq',
            'source'             => 'https://bdthemes.com/secure/rooten/bdthemes-faq.zip?key=4x6e7s3ed405dy9xz99qw19947742e90',
            'required'           => true,
            'version'            => '1.0.0',
        ),
        array(
            'name'               => esc_html_x('BdThemes Testimonials', 'backend', 'rooten'),
            'slug'               => 'bdthemes-testimonials',
            'source'             => 'https://bdthemes.com/secure/rooten/bdthemes-testimonials.zip?key=4x6e7s3ed405dy9xz99qw19947742e90',
            'required'           => true,
            'version'            => '1.0.0',
        ),
        array(
            'name'               => esc_html_x('Elementor Page Builder', 'backend', 'rooten'),
            'slug'               => 'elementor',
            'required'           => true,
            'version'            => '2.0.8',
        ),
        array(
            'name'               => esc_html_x('Element Pack - Elementor Addon', 'backend', 'rooten'),
            'slug'               => 'bdthemes-element-pack',
            'source'             => 'https://bdthemes.com/portfolio-item/element-pack/',
            'required'           => true,
            'version'            => '2.0.0',
        ),
        array(
            'name' => esc_html_x('Contact Form 7', 'backend', 'rooten'),
            'slug' => 'contact-form-7',
        ),
        array(
            'name' => esc_html_x('MailChimp for WordPress', 'backend', 'rooten'),
            'slug' => 'mailchimp-for-wp',
        ),
        array(
            'name' => esc_html_x('WooCommerce', 'backend', 'rooten'),
            'slug' => 'woocommerce',
        ),
        array(
            'name' => esc_html_x('SVG Support', 'backend', 'rooten'),
            'slug' => 'svg-support',
        ),

        // This is an example of the use of 'is_callable' functionality. A user could - for instance -
        // have WPSEO installed *or* WPSEO Premium. The slug would in that last case be different, i.e.
        // 'wordpress-seo-premium'.
        // By setting 'is_callable' to either a function from that plugin or a class method
        // `array( 'class', 'method' )` similar to how you hook in to actions and filters, TGMPA can still
        // recognize the plugin as being installed.
        array(
            'name'        => esc_html_x('WordPress SEO by Yoast', 'backend', 'rooten'),
            'slug'        => 'wordpress-seo',
            'is_callable' => 'wpseo_init',
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'rooten',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}


if (class_exists('RevSlider') or class_exists('UniteFunctionsWPBiz')) {
    add_action( 'admin_head', 'admin_css' );
    function admin_css() { ?>
         <style type="text/css">
             div#tp-validation-box, div.rs-update-notice-wrap {
                 display: none !important;
             }
         </style>
    <?php
    }
}
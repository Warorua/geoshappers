<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rooten
 */

$message        = get_theme_mod( 'rooten_cookie_message' );
$accept_button  = get_theme_mod( 'rooten_cookie_accept_button', true );
$decline_button = get_theme_mod( 'rooten_cookie_decline_button', false );
$policy_button  = get_theme_mod( 'rooten_cookie_policy_button', false );
$policy_url     = get_theme_mod( 'rooten_cookie_policy_url', '/privacy-policy/' );
$expire_days    = get_theme_mod( 'rooten_cookie_expire_days', 365 );
$position       = get_theme_mod( 'rooten_cookie_position' );
$dev_mode       = get_theme_mod( 'rooten_cookie_debug' );


$cookie_settings = [
	'message'       => ($message) ? esc_html( $message ) : esc_html__( 'We use cookies to ensure that we give you the best experience on our website.', 'rooten' ),
	'acceptButton'  => $accept_button,
	'acceptText'    => esc_html__( 'I Understand', 'rooten' ),
	'declineButton' => $decline_button,
	'declineText'   => esc_html__( 'Disable Cookies', 'rooten' ),
	'policyButton'  => $policy_button,
	'policyText'    => esc_html__( 'Privacy Policy', 'rooten' ),
	'policyURL'     => esc_url( $policy_url),
	'expireDays'    => $expire_days,
	'bottom'        => ($position) ? true : false,
	'forceShow'     => ($dev_mode) ? true : false,
]


?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery.cookieBar(<?php echo json_encode($cookie_settings); ?>);
	});
</script>
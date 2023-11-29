<?php 
/* Template Name: Blank Page */

get_header();

$bg_style         = get_theme_mod( 'rooten_body_bg_style');
//$mainbody_width = get_theme_mod( 'rooten_body_width');
$text             = get_theme_mod( 'rooten_body_txt_style' );


$class            = ['bdt-section', 'bdt-padding-remove-vertical'];
$class[]          = ($bg_style) ? 'bdt-section-'.$bg_style : '';
$class[]          = ($text) ? 'bdt-'.$text : '';


?>



<div<?php echo rooten_helper::attrs(['id' => $id, 'class' => $class]); ?>>
	<div class="">
		<main class="tm-home">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>
		</main> <!-- end main -->

	</div> <!-- end container -->
</div> <!-- end tm main -->
	
<?php get_footer(); ?>
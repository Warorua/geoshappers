<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rooten
 */


$position = (get_post_meta( get_the_ID(), 'rooten_page_layout', true )) ? get_post_meta( get_the_ID(), 'rooten_page_layout', true ) : get_theme_mod( 'rooten_page_layout', 'sidebar-right' );

if($position == 'sidebar-left' || $position == 'sidebar-right') { ?>

	<aside<?php echo rooten_helper::sidebar(); ?>>
	    <?php get_sidebar(); ?>
	</aside> <!-- end aside -->

<?php }

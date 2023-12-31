<?php get_header();

// Layout
$layout = get_post_meta( get_the_ID(), 'rooten_page_layout', true );
$position = (!empty($layout)) ? $layout : get_theme_mod( 'rooten_page_layout', 'sidebar-right' );

$class[] = ($layout !== 'full') ? 'bdt-container' : ''; 

?>



<div<?php echo rooten_helper::section('main'); ?>>
	<div<?php echo rooten_helper::attrs(['class' => $class]) ?>>
		<div<?php echo rooten_helper::grid(); ?>>
			<div class="bdt-width-expand">
				<main class="tm-content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php the_content(); ?>

						<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

						<?php if(get_theme_mod('rooten_comment_show', 1) == 1 and comments_open()) { ?>
							<hr class="bdt-margin-large-top bdt-margin-large-bottom">

							<?php comments_template(); ?>
						<?php } ?>

					<?php endwhile; endif; ?>
				</main> <!-- end main -->
			</div> <!-- end content -->

			<?php if($position == 'sidebar-left' or $position == 'sidebar-right') : ?>
				<aside<?php echo rooten_helper::sidebar($position); ?>>
				    <?php get_sidebar(); ?>
				</aside> <!-- end aside -->
			<?php endif; ?>

		</div> <!-- end grid -->
	</div> <!-- end container -->
</div> <!-- end tm main -->
	
<?php get_footer(); ?>

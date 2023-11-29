<?php get_header(); 

// Layout
$position = (get_post_meta( get_the_ID(), 'rooten_page_layout', true )) ? get_post_meta( get_the_ID(), 'rooten_page_layout', true ) : get_theme_mod( 'rooten_page_layout', 'sidebar-right' );
?>



<div<?php echo rooten_helper::section(); ?>>
	<div<?php echo rooten_helper::container(); ?>>
		<div<?php echo rooten_helper::grid(); ?>>
			<div class="bdt-width-expand">
				<main class="tm-content bdt-text-<?php echo get_theme_mod('rooten_blog_align', 'left'); ?>">
			
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<?php get_template_part( 'template-parts/post-format/entry', get_post_format() ); ?>
						
						
						<?php get_template_part( 'template-parts/author' ); ?>
							
						<?php if(get_theme_mod('rooten_related_post')) { ?>	
						
								<?php //for use in the loop, list 5 post titles related to first tag on current post
								$tags = wp_get_post_tags($post->ID);
								if($tags) {
								?>

								<div id="related-posts">
									<h3 class="bdt-heading-bullet bdt-margin-medium-bottom"><?php esc_html_e('Related Posts', 'rooten'); ?></h3>
									<ul class="bdt-list bdt-list-divider">
										<?php  $first_tag = $tags[0]->term_id;
										  $args=array(
										    'tag__in' => array($first_tag),
										    'post__not_in' => array($post->ID),
										    'showposts'=>4
										   );
										  $my_query = new WP_Query($args);
										  if( $my_query->have_posts() ) {
										    while ($my_query->have_posts()) : $my_query->the_post(); ?>
										      <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" class="bdt-link-reset bdt-margin-small-right"><?php the_title(); ?></a> <span class="bdt-article-meta"><?php the_time(get_option('date_format')); ?></span></li>
										      <?php
										    endwhile;
										    wp_reset_postdata();
										  } ?>
									</ul>
								</div>

								<hr class="bdt-margin-large-top bdt-margin-large-bottom">
								
								<?php } // end if $tags ?>

						<?php } ?>
					
						<?php comments_template(); ?>
						
						<?php if(get_theme_mod('rooten_blog_next_prev', 1)) { ?>

							<hr>	

							<ul class="bdt-pagination">
							    <li>
							    	<?php
							        	$pre_btn_txt = '<span class="bdt-margin-small-right" bdt-pagination-previous></span> '. esc_html__('Previous', 'rooten'); 
							        	previous_post_link('%link', "{$pre_btn_txt}", FALSE); 
							        ?>
							        
							    </li>
							    <li class="bdt-margin-auto-left">
							    	<?php $next_btn_txt = esc_html__('Next', 'rooten') . ' <span class="bdt-margin-small-left" bdt-pagination-next></span>';
		                    			next_post_link('%link', "{$next_btn_txt}", FALSE); ?>
		                    	</li>
							</ul>
						<?php } ?>
				
					<?php endwhile; endif; ?>
				</main> <!-- end main -->
			</div> <!-- end expand -->

			<?php if(is_active_sidebar( 'blog-widgets' ) and ($position == 'sidebar-left' or $position == 'sidebar-right')) : ?>
				<aside<?php echo rooten_helper::sidebar($position); ?>>
				    <?php get_sidebar(); ?>
				</aside> <!-- end aside -->
			<?php endif; ?>
			
		</div> <!-- end grid -->
	</div> <!-- end container -->
</div> <!-- end tm main -->
	
<?php get_footer(); ?>
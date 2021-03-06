<?php 
/**
 * GenesisAwesome Flexslider for Child Themes.
 * 
 * @package Genesis Child Theme
 * @author  Harish Dasari
 * @version 1.0
 * @link    http://www.genesisawesome.com/
 */

add_action( 'genesis_after_header', 'genesisawesome_flexslider', 20 );
/**
 * GenesisAwesome Responsive Flexslider
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_flexslider() {

	if ( ! is_home() || ! genesis_get_option( 'enable_homepage_slider', GA_CHILDTHEME_FIELD ) )
		return;

	/* Custom Query Args */
	$ga_slider_args = array(
		'posts_per_page' => absint( genesis_get_option( 'homepage_slider_number', GA_CHILDTHEME_FIELD ) ),
		'cat'            => absint( genesis_get_option( 'homepage_slider_category', GA_CHILDTHEME_FIELD ) )
	);

	/* Creating new WP Query */
	$ga_slider_query = new WP_Query( $ga_slider_args );

	/* THE CUSTOM LOOP */
	if ( $ga_slider_query->have_posts() ) {
	?>
	<div id="dedicated-slider" class="flexslider">
		<ul class="slides">
		<?php
		while ( $ga_slider_query->have_posts() ) {
			$ga_slider_query->the_post();
			if ( $slide_image = genesis_get_image( array( 'size' => 'dedicated-slider-image' ) ) ) {			
				?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $slide_image; ?></a>
					<div class="flex-caption">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					</div>
				</li>
				<?php
			}
		}
		?>
		</ul>
	</div>
	<?php
	}

	/* we should reset the custom query */
	wp_reset_query();

}
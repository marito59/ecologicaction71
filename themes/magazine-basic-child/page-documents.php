<?php
/**
 * Template Name: Page Documents
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 3.0.0
 */
get_header(); ?>

	<div id="primary" <?php bavotasan_primary_attr(); ?> role="main">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

			// begin modif CMA
			// select documents category as root
			$args = array('child_of' => 9, 'order_by' => 'name', 'order' => 'DESC');
			$categories = get_categories( $args );
			$prev_cat = '';
			$cat_level = 0;

			// pour chaque catégorie, affiche le nom puis les articles correspondants avec leurs attachements
			foreach($categories as $category) { 
				if ($prev_cat != $category) {
					$cat_level++;
					$prev_cat = $category;
				}
				?>
				<div class="category_name cat_level_<?php echo $cat_level;?>"><?php echo $category->name; ?></div>
			<?php
				// display attachments (function from functions.php)
				$second_query = new WP_Query(array('category__in'=>$category->term_id, 'post_type'=>'post', 'posts_per_page'=>-1, 'order'=>'ASC', 'orderby'=>'menu_order'));
				
				// The Loop
				while( $second_query->have_posts() ) : $second_query->the_post();
					get_template_part( 'template-parts/content', 'documents' );				
				endwhile;
		
				wp_reset_query();
				
			}
			// end Modif CMA
			comments_template( '', true );

		endwhile; // end of the loop.
		?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
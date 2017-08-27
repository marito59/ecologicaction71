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
			
			// select documents category
			$args = array('child_of' => 9, 'order_by' => 'name', 'order' => 'DESC');
			$categories = get_categories( $args );
			$prev_cat = '';
			$cat_level = 0;

			foreach($categories as $category) { 
				if ($prev_cat != $category) {
					$cat_level++;
					$prev_cat = $category;
				}
				//if ($category->count != 0) { ?>
					<div class="category_name cat_level_<?php echo $catlevel;?>"><?php echo $category->name; ?></div>
			<?php
					ecologic_docs($category->term_id);
				//}
			}
			
			comments_template( '', true );

		endwhile; // end of the loop.
		?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
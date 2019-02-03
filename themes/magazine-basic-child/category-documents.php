<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 3.0.0
 */
get_header(); ?>

	<section id="primary" <?php bavotasan_primary_attr(); ?> role="main">

		<?php if ( have_posts() ) : ?>

			<header id="archive-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<h2 class="archive-meta">', '</h2>' );

					global $cma_category;
					$cma_category = '';
				?>
			</header><!-- #archive-header -->

			<?php
    if (is_category()) {
    $this_category = get_category($cat);
    }
    ?>
    <?php
    if($this_category->category_parent)
    $this_category = wp_list_categories('orderby=id&show_count=0
    &title_li=&use_desc_for_title=1&child_of='.$this_category->category_parent.
    "&echo=0"); else
    $this_category = wp_list_categories('orderby=id&depth=1&show_count=0
    &title_li=&use_desc_for_title=1&child_of='.$this_category->cat_ID.
    "&echo=0");
    if ($this_category) { ?> 
 
<ul>
<?php echo $this_category; ?>
 
</ul>
 
<?php } ?>

			<?php
			while ( have_posts() ) : the_post();
		    	global $mb_content_area;
				$mb_content_area = 'main';  

				$cat = the_category();
				if ($cat != $cma_category) {
					$cma_category = $cat;
					?>
					<h2 class="category_header"><?php echo $cat; ?></h2>
					<?php
				}
				
		      	/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
		    	get_template_part( 'template-parts/content', get_post_format() );

		    endwhile;

			bavotasan_pagination();

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

	</section><!-- #primary.c8 -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
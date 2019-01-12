<?php
/**
 * The template used for displaying post content with attachements
 *
 * @since 3.0.0
 */
$class = bavotasan_article_class();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<div class="document-thumb">
		<?php
		if ( has_post_thumbnail() ) {
			$attr = array(
				'class' => "documents-thumb",
				'alt'   => "thumbnail"
			);
			the_post_thumbnail( 'document-thumb' ); 
		} else { 
		?> 	&nbsp; <?php
		}?></div>
		<div class="document-content"><?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	    	<div class="entry-content">
		  	  <?php the_content(); ?>
			
	<?php
		$file = get_field('media_attache');
		if( $file ) {
			// vars
			$url = $file['url'];
			$title = $file['title'];
			$caption = $file['caption'];
			?>
			<ul><li>
			<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
				<span><?php echo $title; ?></span>
			</a>
			</li></ul>
		<?php } ?>
			</div><!-- .entry-content -->
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
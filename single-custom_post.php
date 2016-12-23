<?php
get_header();

if (have_posts()) :
	while (have_posts()) : the_post();
?>

<article>
	<header>
		<h1><?php the_title(); ?></h1>
		<p><?php echo get_the_term_list($id_post, 'custom_taxonomy', '', ', '); ?></p>
		<p>Published: <?php the_time('d/m/Y'); ?></p>
	</header>

		<?php
		if (has_post_thumbnail()) :
			$image_size = 'large';
			$image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), $image_size);
			$image_url = $image_thumb['0'];
			$resized_image = aq_resize($image_url, 500, 500, true, true, true);
		?>

	<img class="lazy img-responsive pull-left thumbnail-post" src="<?php echo get_template_directory_uri(); ?>/img/dist/transparent.gif" data-original="<?php echo $resized_image; ?>" alt="<?php the_title(); ?>" width="500" height="500">

		<?php
		endif;
		?>

			<?php the_content(); ?>
</article>

<?php
	endwhile;
endif;

get_footer();
?>

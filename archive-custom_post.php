<?php get_header(); ?>
<section>
	<header>
		<h1>Archive Custom Posts</h1>
	</header>

<?php
$counter = 0;

if (have_posts()) :
	while (have_posts()) : the_post();
		if ($counter % 2 == 0) :
?>

	<div class="row">

		<?php
		endif;
		?>

		<article class="col-md-6">
			<div class="thumbnail">

		<?php
		if (has_post_thumbnail()) :
			$image_size = 'large';
			$image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), $image_size);
			$image_url = $image_thumb['0'];
			$resized_image = aq_resize($image_url, 710, 500, true, true, true);
		?>

				<a href="<?php the_permalink(); ?>"><img class="lazy img-responsive" data-original="<?php echo $resized_image; ?>" alt="<?php the_title(); ?>" width="710" height="500"></a>

		<?php
		endif;
		?>

				<div class="caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p><?php echo get_the_term_list($id_post, 'custom_taxonomy', '', ', '); ?></p>
					<p class="data">Published: <?php the_time('d/m/Y'); ?></p>
						<?php the_excerpt(); ?>
				</div>
			</div>
		</article>

		<?php
		if (($counter + 1) % 2 == 0 || $wp_query->current_post + 1 == $wp_query->post_count) :
		?>

	</div>

		<?php
		endif;

		$counter++;
	endwhile;

	if (function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}
endif;
?>

</section>
<?php get_footer(); ?>

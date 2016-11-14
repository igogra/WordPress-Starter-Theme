<?php
$args = array(
	'post_type'      => 'custom_post',
	'posts_per_page' => 2
);
$query = new WP_Query($args);

if ($query->have_posts()) :
?>

<section>
	<header>
		<h1>Last posts <small><a href="<?php echo get_post_type_archive_link('custom_post'); ?>">See all</a></small></h1>
	</header>
	<div class="row">

	<?php
	while ($query->have_posts()) : $query->the_post();
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
	endwhile;
	?>

	</div>
</section>

<?php
	wp_reset_postdata();
endif;
?>

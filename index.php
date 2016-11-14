<?php
get_header();
//query_posts('post_type=home');

/*if (have_posts()) :
	while (have_posts()) : the_post();*/
		get_template_part('content-home', 'page');
/*	endwhile;
endif;*/

get_footer();
?>

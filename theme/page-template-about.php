<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package optimalu-e-scan
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/sections/about-page/hero' );
	get_template_part( 'template-parts/sections/about-page/history' );
	get_template_part( 'template-parts/sections/about-page/timeline' );
	get_template_part( 'template-parts/sections/about-page/values' );
	get_template_part( 'template-parts/sections/about-page/stats' );
	get_template_part( 'template-parts/sections/specialists' );
	get_template_part( 'template-parts/sections/about-page/cta' );
endwhile;
?>

<?php
get_footer();

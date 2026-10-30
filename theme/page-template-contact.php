<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * @package optimalu-e-scan
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/sections/contact-page/hero' );
	get_template_part( 'template-parts/sections/contact-page/details' );
	get_template_part( 'template-parts/sections/contact-page/map' );
endwhile;
?>

<?php
get_footer();

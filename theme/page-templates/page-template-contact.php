<?php
/**
 * Template Name: Contact Section
 * Template Post Type: page
 *
 * @package optimalu-e-scan
 */

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/sections/contact', null, array( 'post_id' => get_the_ID() ) );
endwhile;

get_footer();

<?php
/**
 * Template Name: CT Service Page
 * Template Post Type: page
 *
 * @package optimalu-e-scan
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/sections/ct-service/hero' );
	echo '<div class="ct-service-intro">';
	echo '<div class="ct-service-intro__inner">';
	get_template_part( 'template-parts/sections/ct-service/featured' );
	get_template_part( 'template-parts/sections/ct-service/about' );
	echo '</div>';
	echo '</div>';
	get_template_part( 'template-parts/sections/ct-service/exams' );
	get_template_part( 'template-parts/sections/ct-service/process' );
	get_template_part( 'template-parts/sections/ct-service/preparation' );
	get_template_part( 'template-parts/sections/ct-service/gallery' );
	get_template_part( 'template-parts/sections/ct-service/faq' );
	get_template_part( 'template-parts/sections/ct-service/cta' );
endwhile;
?>

<?php
get_footer();

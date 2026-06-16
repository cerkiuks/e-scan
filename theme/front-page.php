<?php
/**
 * Front page template.
 *
 * @package optimalu-e-scan
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/sections/hero' );
	get_template_part( 'template-parts/sections/about' );
	get_template_part( 'template-parts/sections/philosophy' );
	get_template_part( 'template-parts/sections/ct' );
	get_template_part( 'template-parts/sections/registration' );
endwhile;
?>

<?php
get_footer();

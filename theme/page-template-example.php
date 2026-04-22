<?php
/**
 * Template Name: Example Template (Agent Test)
 * Template Post Type: page
 *
 * @package optimalu-e-scan
 */

get_header();

$hero_title = get_the_title();
if ( function_exists( 'get_field' ) ) {
	$acf_hero_title = get_field( 'hero_title' );
	if ( ! empty( $acf_hero_title ) ) {
		$hero_title = $acf_hero_title;
	}
}
?>

<section id="primary">
	<main id="main">
		<div class="mx-auto max-w-[1200px] px-6 py-16">
			<h1 class="text-5xl font-semibold leading-tight"><?php echo esc_html( $hero_title ); ?></h1>
			<p class="mt-6 max-w-[700px] text-lg text-gray-700">
				This is an example WordPress page template created by the agent to verify template assignment.
			</p>
		</div>
	</main>
</section>

<?php
get_footer();

<?php
/**
 * Contact page company details and practical FAQ.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_contact_page_details_data();

$has_company = $data['company_title'] || $data['company_items'] || $data['bank_name'] || $data['bank_iban'] || $data['bank_swift'];
$has_faq     = $data['faq_title'] || $data['faq_title_highlight'] || $data['faq_items'];

if ( ! $has_company && ! $has_faq ) {
	return;
}

$company_icons = array(
	'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>',
	'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="9" y2="9"/><line x1="4" x2="20" y1="15" y2="15"/><line x1="10" x2="8" y1="3" y2="21"/><line x1="16" x2="14" y1="3" y2="21"/></svg>',
	'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
);
?>

<section class="contact-page-details" aria-label="<?php esc_attr_e( 'Rekvizitai ir praktinė informacija', 'optimalu-e-scan' ); ?>">
	<div class="contact-page-details__inner">
		<div class="contact-page-details__grid">
			<?php if ( $has_company ) : ?>
				<div class="contact-page-details__company">
					<?php if ( $data['company_eyebrow'] ) : ?>
						<p class="contact-page-kicker"><?php echo esc_html( $data['company_eyebrow'] ); ?></p>
					<?php endif; ?>

					<?php if ( $data['company_title'] ) : ?>
						<h2 class="contact-page-heading"><?php echo esc_html( $data['company_title'] ); ?></h2>
					<?php endif; ?>

					<?php if ( $data['company_items'] ) : ?>
						<ul class="contact-page-details__company-list">
							<?php foreach ( $data['company_items'] as $index => $item ) : ?>
								<li class="contact-page-details__company-item">
									<span class="contact-page-details__company-icon" aria-hidden="true">
										<?php echo $company_icons[ $index % count( $company_icons ) ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG markup. ?>
									</span>
									<div>
										<?php if ( $item['label'] ) : ?>
											<p class="contact-page-details__label"><?php echo esc_html( $item['label'] ); ?></p>
										<?php endif; ?>
										<?php if ( $item['value'] ) : ?>
											<p class="contact-page-details__value"><?php echo esc_html( $item['value'] ); ?></p>
										<?php endif; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( $data['bank_title'] || $data['bank_name'] || $data['bank_iban'] || $data['bank_swift'] ) : ?>
						<div class="contact-page-details__bank">
							<?php if ( $data['bank_title'] ) : ?>
								<p class="contact-page-details__label contact-page-details__label--bank"><?php echo esc_html( $data['bank_title'] ); ?></p>
							<?php endif; ?>

							<?php if ( $data['bank_name'] ) : ?>
								<div class="contact-page-details__bank-row">
									<?php if ( $data['bank_name_label'] ) : ?>
										<p class="contact-page-details__bank-label"><?php echo esc_html( $data['bank_name_label'] ); ?></p>
									<?php endif; ?>
									<p class="contact-page-details__value"><?php echo esc_html( $data['bank_name'] ); ?></p>
								</div>
							<?php endif; ?>

							<?php if ( $data['bank_iban'] ) : ?>
								<div class="contact-page-details__bank-row">
									<?php if ( $data['bank_iban_label'] ) : ?>
										<p class="contact-page-details__bank-label"><?php echo esc_html( $data['bank_iban_label'] ); ?></p>
									<?php endif; ?>
									<p class="contact-page-details__value contact-page-details__value--mono"><?php echo esc_html( $data['bank_iban'] ); ?></p>
								</div>
							<?php endif; ?>

							<?php if ( $data['bank_swift'] ) : ?>
								<div class="contact-page-details__bank-row">
									<?php if ( $data['bank_swift_label'] ) : ?>
										<p class="contact-page-details__bank-label"><?php echo esc_html( $data['bank_swift_label'] ); ?></p>
									<?php endif; ?>
									<p class="contact-page-details__value"><?php echo esc_html( $data['bank_swift'] ); ?></p>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $has_faq ) : ?>
				<div class="contact-page-details__faq">
					<?php if ( $data['faq_eyebrow'] ) : ?>
						<p class="contact-page-kicker"><?php echo esc_html( $data['faq_eyebrow'] ); ?></p>
					<?php endif; ?>

					<?php if ( $data['faq_title'] || $data['faq_title_highlight'] ) : ?>
						<h2 class="contact-page-heading">
							<?php if ( $data['faq_title'] ) : ?>
								<?php echo esc_html( $data['faq_title'] ); ?>
							<?php endif; ?>
							<?php if ( $data['faq_title_highlight'] ) : ?>
								<br>
								<span class="contact-page-heading__accent"><?php echo esc_html( $data['faq_title_highlight'] ); ?></span>
							<?php endif; ?>
						</h2>
					<?php endif; ?>

					<?php if ( $data['faq_items'] ) : ?>
						<div class="contact-page-details__faq-list">
							<?php foreach ( $data['faq_items'] as $faq ) : ?>
								<div class="contact-page-details__faq-item">
									<?php if ( $faq['question'] ) : ?>
										<h3 class="contact-page-details__faq-question"><?php echo esc_html( $faq['question'] ); ?></h3>
									<?php endif; ?>
									<?php if ( $faq['answer'] ) : ?>
										<p class="contact-page-details__faq-answer"><?php echo esc_html( $faq['answer'] ); ?></p>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
/**
 * ACF local field registrations for the theme.
 *
 * @package optimalu-e-scan
 */

/**
 * Register simple ACF fields for the example page template.
 */
function optimalu_e_scan_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_example_template',
			'title'                 => 'Example Template Fields',
			'fields'                => array(
				array(
					'key'           => 'field_optimalu_hero_title',
					'label'         => 'Hero Title',
					'name'          => 'hero_title',
					'aria-label'    => '',
					'type'          => 'text',
					'instructions'  => 'Optional override for the page hero title.',
					'required'      => 0,
					'default_value' => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-template-example.php',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => 'Minimal ACF POC group for example template.',
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_front_page_hero',
			'title'                 => 'Front Page Hero',
			'fields'                => array(
				array(
					'key'           => 'field_optimalu_fp_hero_eyebrow',
					'label'         => 'Hero eyebrow',
					'name'          => 'hero_eyebrow',
					'type'          => 'text',
					'required'      => 0,
					'default_value' => 'Vilnius · Sveikatos diagnostikos centras',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_title',
					'label'         => 'Hero title',
					'name'          => 'hero_title',
					'type'          => 'wysiwyg',
					'instructions'  => 'Main heading. Use line breaks; wrap accent words in <em class="hero__title-accent">.</em>',
					'required'      => 0,
					'default_value' => 'Moderni<br><em class="hero__title-accent">diagnostika</em><br><span class="hero__title-muted">jūsų sveikatai</span>',
					'tabs'          => 'visual',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
					'delay'         => 0,
				),
				array(
					'key'           => 'field_optimalu_fp_hero_description',
					'label'         => 'Hero description',
					'name'          => 'hero_description',
					'type'          => 'textarea',
					'instructions'  => '',
					'required'      => 0,
					'default_value' => 'Kompiuterinė tomografija su aukščiausios klasės įranga ir sertifikuotų radiologų komanda. Tikslūs rezultatai per 24 valandas.',
					'rows'          => 4,
				),
				array(
					'key'           => 'field_optimalu_fp_hero_button_text',
					'label'         => 'Hero button text',
					'name'          => 'hero_button_text',
					'type'          => 'text',
					'required'      => 0,
					'default_value' => 'Registruotis tyrimui',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_button_url',
					'label'         => 'Hero button URL',
					'name'          => 'hero_button_url',
					'type'          => 'url',
					'required'      => 0,
					'default_value' => '/kt-tyrimai/',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_secondary_link_text',
					'label'         => 'Hero secondary link text',
					'name'          => 'hero_secondary_link_text',
					'type'          => 'text',
					'required'      => 0,
					'default_value' => 'Sužinoti apie KT tyrimus',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_secondary_link_url',
					'label'         => 'Hero secondary link URL',
					'name'          => 'hero_secondary_link_url',
					'type'          => 'url',
					'required'      => 0,
					'default_value' => '#ct',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_image',
					'label'         => 'Hero image',
					'name'          => 'hero_image',
					'type'          => 'image',
					'instructions'  => 'Displayed in the right-side image frame on desktop.',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_card_label',
					'label'         => 'Appointment card label',
					'name'          => 'hero_card_label',
					'type'          => 'text',
					'required'      => 0,
					'default_value' => 'Laisvas laikas',
				),
				array(
					'key'           => 'field_optimalu_fp_hero_card_value',
					'label'         => 'Appointment card value',
					'name'          => 'hero_card_value',
					'type'          => 'text',
					'required'      => 0,
					'default_value' => 'Šiandien 14:30',
				),
				array(
					'key'          => 'field_optimalu_fp_hero_stats',
					'label'        => 'Hero stats',
					'name'         => 'hero_stats',
					'type'         => 'group',
					'instructions' => 'Bottom statistics row (4 items).',
					'required'     => 0,
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_optimalu_fp_stat_1_value',
							'label'         => 'Stat 1 value',
							'name'          => 'stat_1_value',
							'type'          => 'text',
							'default_value' => '12+',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_1_label',
							'label'         => 'Stat 1 label',
							'name'          => 'stat_1_label',
							'type'          => 'text',
							'default_value' => 'Metų patirtis',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_2_value',
							'label'         => 'Stat 2 value',
							'name'          => 'stat_2_value',
							'type'          => 'text',
							'default_value' => '15 000+',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_2_label',
							'label'         => 'Stat 2 label',
							'name'          => 'stat_2_label',
							'type'          => 'text',
							'default_value' => 'Pacientų aptarnauta',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_3_value',
							'label'         => 'Stat 3 value',
							'name'          => 'stat_3_value',
							'type'          => 'text',
							'default_value' => '98%',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_3_label',
							'label'         => 'Stat 3 label',
							'name'          => 'stat_3_label',
							'type'          => 'text',
							'default_value' => 'Pasitenkinimas',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_4_value',
							'label'         => 'Stat 4 value',
							'name'          => 'stat_4_value',
							'type'          => 'text',
							'default_value' => '24h',
						),
						array(
							'key'           => 'field_optimalu_fp_stat_4_label',
							'label'         => 'Stat 4 label',
							'name'          => 'stat_4_label',
							'type'          => 'text',
							'default_value' => 'Rezultatų laikas',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_front_page_about',
			'title'                 => 'Front Page About',
			'fields'                => array(
				array(
					'key'           => 'field_optimalu_fp_about_eyebrow',
					'label'         => 'About eyebrow',
					'name'          => 'about_eyebrow',
					'type'          => 'text',
					'default_value' => 'Apie mus',
				),
				array(
					'key'           => 'field_optimalu_fp_about_title',
					'label'         => 'About title',
					'name'          => 'about_title',
					'type'          => 'wysiwyg',
					'instructions'  => 'Use line breaks; wrap muted words in <span class="about__title-muted">.</span>',
					'default_value' => 'Diagnostikos centras,<br><span class="about__title-muted">kuriam rūpite jūs</span>',
					'tabs'          => 'visual',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
				),
				array(
					'key'           => 'field_optimalu_fp_about_paragraph_1',
					'label'         => 'About paragraph 1',
					'name'          => 'about_paragraph_1',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Nuo 2012 metų teikiame aukštos kokybės diagnostikos paslaugas Vilniuje. Specializuojamės kompiuterinėje tomografijoje — procedūroje, leidžiančioje tiksliai diagnozuoti ligas ir stebėti gydymo eigą.',
				),
				array(
					'key'           => 'field_optimalu_fp_about_paragraph_2',
					'label'         => 'About paragraph 2',
					'name'          => 'about_paragraph_2',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Kiekvienas pacientas mums — individualus. Mūsų specialistai ne tik atlieka tyrimus, bet konsultuoja, padeda suprasti rezultatus ir rekomenduoja tolesnius žingsnius.',
				),
				array(
					'key'           => 'field_optimalu_fp_about_link_text',
					'label'         => 'About link text',
					'name'          => 'about_link_text',
					'type'          => 'text',
					'default_value' => 'Susisiekti su mumis',
				),
				array(
					'key'           => 'field_optimalu_fp_about_link_url',
					'label'         => 'About link URL',
					'name'          => 'about_link_url',
					'type'          => 'url',
					'default_value' => '/kontaktai/',
				),
				array(
					'key'          => 'field_optimalu_fp_about_highlights',
					'label'        => 'About highlights',
					'name'         => 'about_highlights',
					'type'         => 'group',
					'instructions' => 'Highlight cards in the right column (4 items).',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_optimalu_fp_highlight_1_value',
							'label'         => 'Highlight 1 value',
							'name'          => 'highlight_1_value',
							'type'          => 'text',
							'default_value' => '12+',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_1_label',
							'label'         => 'Highlight 1 label',
							'name'          => 'highlight_1_label',
							'type'          => 'text',
							'default_value' => 'Metų rinkoje',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_1_sub',
							'label'         => 'Highlight 1 sub label',
							'name'          => 'highlight_1_sub',
							'type'          => 'text',
							'default_value' => 'Patikimumas ir patirtis',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_2_value',
							'label'         => 'Highlight 2 value',
							'name'          => 'highlight_2_value',
							'type'          => 'text',
							'default_value' => '15K+',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_2_label',
							'label'         => 'Highlight 2 label',
							'name'          => 'highlight_2_label',
							'type'          => 'text',
							'default_value' => 'Pacientų',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_2_sub',
							'label'         => 'Highlight 2 sub label',
							'name'          => 'highlight_2_sub',
							'type'          => 'text',
							'default_value' => 'Aptarnauta per metus',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_3_value',
							'label'         => 'Highlight 3 value',
							'name'          => 'highlight_3_value',
							'type'          => 'text',
							'default_value' => '98%',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_3_label',
							'label'         => 'Highlight 3 label',
							'name'          => 'highlight_3_label',
							'type'          => 'text',
							'default_value' => 'Pasitenkinimas',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_3_sub',
							'label'         => 'Highlight 3 sub label',
							'name'          => 'highlight_3_sub',
							'type'          => 'text',
							'default_value' => 'Pacientų įvertinimas',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_4_value',
							'label'         => 'Highlight 4 value',
							'name'          => 'highlight_4_value',
							'type'          => 'text',
							'default_value' => '3',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_4_label',
							'label'         => 'Highlight 4 label',
							'name'          => 'highlight_4_label',
							'type'          => 'text',
							'default_value' => 'Specialistai',
						),
						array(
							'key'           => 'field_optimalu_fp_highlight_4_sub',
							'label'         => 'Highlight 4 sub label',
							'name'          => 'highlight_4_sub',
							'type'          => 'text',
							'default_value' => 'Sertifikuoti radiologai',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_front_page_philosophy',
			'title'                 => 'Front Page Philosophy',
			'fields'                => array(
				array(
					'key'          => 'field_optimalu_fp_philosophy_marquee',
					'label'        => 'Philosophy marquee',
					'name'         => 'philosophy_marquee',
					'type'         => 'group',
					'instructions' => 'Scrolling ticker phrases at the top of the section.',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_optimalu_fp_marquee_1',
							'label'         => 'Marquee phrase 1',
							'name'          => 'marquee_1',
							'type'          => 'text',
							'default_value' => 'Kompiuterinė tomografija',
						),
						array(
							'key'           => 'field_optimalu_fp_marquee_2',
							'label'         => 'Marquee phrase 2',
							'name'          => 'marquee_2',
							'type'          => 'text',
							'default_value' => 'Tikslumas ir greitis',
						),
						array(
							'key'           => 'field_optimalu_fp_marquee_3',
							'label'         => 'Marquee phrase 3',
							'name'          => 'marquee_3',
							'type'          => 'text',
							'default_value' => 'Profesionalūs specialistai',
						),
						array(
							'key'           => 'field_optimalu_fp_marquee_4',
							'label'         => 'Marquee phrase 4',
							'name'          => 'marquee_4',
							'type'          => 'text',
							'default_value' => 'Jūsų sveikatos labui',
						),
						array(
							'key'           => 'field_optimalu_fp_marquee_5',
							'label'         => 'Marquee phrase 5',
							'name'          => 'marquee_5',
							'type'          => 'text',
							'default_value' => 'Modernios technologijos',
						),
					),
				),
				array(
					'key'           => 'field_optimalu_fp_philosophy_eyebrow',
					'label'         => 'Philosophy eyebrow',
					'name'          => 'philosophy_eyebrow',
					'type'          => 'text',
					'default_value' => 'Mūsų filosofija',
				),
				array(
					'key'           => 'field_optimalu_fp_philosophy_title',
					'label'         => 'Philosophy title',
					'name'          => 'philosophy_title',
					'type'          => 'wysiwyg',
					'instructions'  => 'Wrap accent words in <em class="philosophy__title-accent">.</em>',
					'default_value' => 'Tikslumas, kuris <em class="philosophy__title-accent">keičia gydymą</em>',
					'tabs'          => 'visual',
					'toolbar'       => 'basic',
					'media_upload'  => 0,
				),
				array(
					'key'           => 'field_optimalu_fp_philosophy_description',
					'label'         => 'Philosophy description',
					'name'          => 'philosophy_description',
					'type'          => 'textarea',
					'rows'          => 4,
					'default_value' => 'Šiuolaikinė diagnostika yra gydymo pagrindas. Investuojame į technologijas, kad jūsų gydytojai turėtų aiškiausius atsakymus.',
				),
				array(
					'key'          => 'field_optimalu_fp_philosophy_pillars',
					'label'        => 'Philosophy pillars',
					'name'         => 'philosophy_pillars',
					'type'         => 'group',
					'instructions' => 'Three pillar cards below the intro.',
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_optimalu_fp_pillar_1_num',
							'label'         => 'Pillar 1 number',
							'name'          => 'pillar_1_num',
							'type'          => 'text',
							'default_value' => '01',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_1_title',
							'label'         => 'Pillar 1 title',
							'name'          => 'pillar_1_title',
							'type'          => 'text',
							'default_value' => 'Greita',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_1_desc',
							'label'         => 'Pillar 1 description',
							'name'          => 'pillar_1_desc',
							'type'          => 'text',
							'default_value' => 'Rezultatai per 24 valandas',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_2_num',
							'label'         => 'Pillar 2 number',
							'name'          => 'pillar_2_num',
							'type'          => 'text',
							'default_value' => '02',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_2_title',
							'label'         => 'Pillar 2 title',
							'name'          => 'pillar_2_title',
							'type'          => 'text',
							'default_value' => 'Tiksli',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_2_desc',
							'label'         => 'Pillar 2 description',
							'name'          => 'pillar_2_desc',
							'type'          => 'text',
							'default_value' => '512-eilučių CT skaneris',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_3_num',
							'label'         => 'Pillar 3 number',
							'name'          => 'pillar_3_num',
							'type'          => 'text',
							'default_value' => '03',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_3_title',
							'label'         => 'Pillar 3 title',
							'name'          => 'pillar_3_title',
							'type'          => 'text',
							'default_value' => 'Saugi',
						),
						array(
							'key'           => 'field_optimalu_fp_pillar_3_desc',
							'label'         => 'Pillar 3 description',
							'name'          => 'pillar_3_desc',
							'type'          => 'text',
							'default_value' => 'Minimali spinduliuotės dozė',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'optimalu_e_scan_register_acf_fields' );

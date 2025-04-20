<?php

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'rizomacoop_editor_style' ) ) :
	function rizomacoop_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'rizomacoop_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'rizomacoop_enqueue_styles' ) ) :
	function rizomacoop_enqueue_styles() {
		wp_enqueue_style(
			'rizomacoop-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'rizomacoop_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'rizomacoop_block_styles' ) ) :
	function rizomacoop_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'rizomacoop' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'rizomacoop_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'rizomacoop_pattern_categories' ) ) :
	function rizomacoop_pattern_categories() {

		register_block_pattern_category(
			'rizomacoop_page',
			array(
				'label'       => __( 'Pages', 'rizomacoop' ),
				'description' => __( 'A collection of full page layouts.', 'rizomacoop' ),
			)
		);

		register_block_pattern_category(
			'rizomacoop_post-format',
			array(
				'label'       => __( 'Post formats', 'rizomacoop' ),
				'description' => __( 'A collection of post format patterns.', 'rizomacoop' ),
			)
		);
	}
endif;
add_action( 'init', 'rizomacoop_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'rizomacoop_register_block_bindings' ) ) :
	function rizomacoop_register_block_bindings() {
		register_block_bindings_source(
			'rizomacoop/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'rizomacoop' ),
				'get_value_callback' => 'rizomacoop_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'rizomacoop_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'rizomacoop_format_binding' ) ) :
	function rizomacoop_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

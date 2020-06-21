<?php
add_action( 'after_setup_theme', 'ohfnext_setup' );
function ohfnext_setup() {
    load_theme_textdomain( 'ohfnext', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    // add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'align-wide' );

    global $content_width;
    if ( ! isset( $content_width ) ) { $content_width = 1920; }

    register_nav_menus( [
        'main-menu' => esc_html__( 'Main Menu', 'ohfnext' ),
    ] );

    add_theme_support('disable-custom-font-sizes');

    wp_register_style( 'ohfnext-blocks-style', get_template_directory_uri() . '/css/blocks.css' );

    // wp_register_style( 'ohfnext-blocks-style', get_template_directory_uri() . '/css/blocks.css' );
    // register_block_style(
    //     'core/paragraph',
    //     [
    //         'name'         => 'bg-blue',
    //         'label'        => 'Blue background',
    //         'style_handle' => 'ohfnext-blocks-style'
    //     ],
    // );

    add_theme_support( 'disable-custom-colors' );
    // add_theme_support( 'editor-color-palette' );
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name'  => esc_html__( 'Blue', 'ohfnext' ),
				'slug'  => 'blue',
				'color' => '#5832ff',
			],
			[
				'name'  => esc_html__( 'Yellow', 'ohfnext' ),
				'slug'  => 'yellow',
				'color' => '#ffd100',
			],
			[
				'name'  => esc_html__( 'Teal', 'ohfnext' ),
				'slug'  => 'teal',
				'color' => '#00c399',
			],
			[
				'name'  => esc_html__( 'Red', 'ohfnext' ),
				'slug'  => 'red',
				'color' => '#ff1a30',
            ],
			[
				'name'  => esc_html__( 'White', 'ohfnext' ),
				'slug'  => 'white',
				'color' => '#ffffff',
            ],
			[
				'name'  => esc_html__( 'Black', 'ohfnext' ),
				'slug'  => 'black',
				'color' => '#000000',
			],
		]
    );

    add_theme_support( 'editor-gradient-presets' );
    add_theme_support( 'disable-custom-gradients' );

}

add_action( 'wp_enqueue_scripts', 'ohfnext_load_scripts' );
function ohfnext_load_scripts() {
    wp_enqueue_style( 'ohfnext-style', get_stylesheet_uri() );
}

add_filter( 'document_title_separator', 'ohfnext_document_title_separator' );
function ohfnext_document_title_separator( $sep ) {
    $sep = '|';
    return $sep;
}

add_filter( 'the_title', 'ohfnext_title' );
function ohfnext_title( $title ) {
    if ( $title == '' ) {
        return '...';
    } else {
        return $title;
    }
}

add_filter( 'the_content_more_link', 'ohfnext_read_more_link' );
function ohfnext_read_more_link() {
    if ( ! is_admin() ) {
        return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
    }
}

add_filter( 'excerpt_more', 'ohfnext_excerpt_read_more_link' );
function ohfnext_excerpt_read_more_link( $more ) {
    if ( ! is_admin() ) {
        global $post;
        return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
    }
}

add_filter( 'intermediate_image_sizes_advanced', 'ohfnext_image_insert_override' );
function ohfnext_image_insert_override( $sizes ) {
    unset( $sizes['medium_large'] );
    return $sizes;
}

// add_action( 'enqueue_block_editor_assets', 'ohfnext_enqueue' );
// function ohfnext_enqueue() {
//     wp_enqueue_script(
//         'ohfnext-blocks',
//         get_template_directory_uri() . '/js/blocks.js',
//         [ 'wp-blocks', 'wp-dom-ready' ]
//     );
// }

function remove_block_style() {
    // Register the block editor script.
    wp_register_script( 'remove-block-style',
        get_stylesheet_directory_uri() . '/js/remove-block-styles.js',
        [ 'wp-blocks', 'wp-edit-post' ]
    );
    // register block editor script.
    register_block_type( 'remove/block-style', [
        'editor_script' => 'remove-block-style',
    ] );
}
add_action( 'init', 'remove_block_style' );

// function ohfnext_stylesheet() {
//     wp_enqueue_style( 'ohfnext-blocks-css', get_template_directory_uri() . '/css/blocks.css' );
// }
// add_action( 'enqueue_block_assets', 'ohfnext_stylesheet' );

// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'ohfnext_add_gutenberg_assets' );
function ohfnext_add_gutenberg_assets() {
    // Load the theme styles within Gutenberg.
	wp_enqueue_style( 'ohfnext-gutenberg', get_theme_file_uri( 'css/gutenberg-editor-style.css' ), false );
}

// Remove tag line and site icon in customizer
add_action( 'customize_register', 'ohfnext_customize_register' );
function ohfnext_customize_register( $wp_customize ) {
    $wp_customize->remove_control('blogdescription');
    $wp_customize->remove_control('site_icon');
}

// Remove emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Define favicons
add_action('wp_head', 'ohfnext_add_favicon');
function ohfnext_add_favicon() {
    ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/img/favicon.png"/>
        <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/apple-touch-icon.png">
    <?php
}

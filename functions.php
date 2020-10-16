<?php
add_action( 'after_setup_theme', 'ohfnext_setup' );
function ohfnext_setup() {
    load_theme_textdomain( 'ohfnext', get_template_directory() . '/languages' );
	
	
	
	// Add custom Java Script in footer
	function ohfnext_load_scripts() {
		wp_enqueue_style( 'ohfnext-style', get_stylesheet_uri() );		
		wp_enqueue_script('ohfnext-script', get_template_directory_uri() . '/js/script.js','','1.0.0',true);
		}

	add_action( 'wp_enqueue_scripts', 'ohfnext_load_scripts' );




	// 
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

// Add color palette to ACF color picker
function klf_acf_input_admin_footer() { ?>

<script type="text/javascript">
(function($) {

acf.add_filter('color_picker_args', function( args, $field ){

// add the hexadecimal codes here for the colors you want to appear as swatches
args.palettes = ['#ffd100', '#00c399', '#ff1a30', '#5832ff', '#ffffff', '#000000' ]

// return colors
return args;

});

})(jQuery);
</script>

<?php }

add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');

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

// Add image sizes
add_image_size( 'full-width', 3000, 2000, false ); 
add_image_size( 'blog-overview', 700, 400, true );

// Gutenberg ACF blocks
add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register bg_image_with_action_btn block
		acf_register_block(array(
			'name'				=> 'bg_image_with_action_btn',
			'title'				=> __('Background image with action button'),
			'description'		=> __(''),
			'render_callback'	=> 'bg_image_with_action_btn_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'action button', 'background image' ),
		));
		
		// register btn_group block
		acf_register_block(array(
			'name'				=> 'btn_group',
			'title'				=> __('Set of colorful buttons'),
			'description'		=> __(''),
			'render_callback'	=> 'btn_group_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'action button', 'set' ),
		));
		
		// register btn_group block
		acf_register_block(array(
			'name'				=> 'project_overview',
			'title'				=> __('Project overview'),
			'description'		=> __(''),
			'render_callback'	=> 'project_overview_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'action button', 'set' ),
		));
		
		// register btn block
		acf_register_block(array(
			'name'				=> 'btn',
			'title'				=> __('Button'),
			'description'		=> __(''),
			'render_callback'	=> 'btn_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'action button' ),
		));
		
		// register post_list block
		acf_register_block(array(
			'name'				=> 'post_list',
			'title'				=> __('Post list'),
			'description'		=> __(''),
			'render_callback'	=> 'post_list_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'list' ),
		));
		
		// register team_list block
		acf_register_block(array(
			'name'				=> 'team_list',
			'title'				=> __('Team list'),
			'description'		=> __(''),
			'render_callback'	=> 'team_list_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'list', 'team' ),
		));
		
		
		
	}
}

function bg_image_with_action_btn_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-bg_image_with_action_btn.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-bg_image_with_action_btn.php") );
	}
}

function btn_group_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-btn_group.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-btn_group.php") );
	}
}

function project_overview_render_callback( $block ) {
	
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-project_overview.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-project_overview.php") );
	}
}

function btn_render_callback( $block ) {
	
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-btn.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-btn.php") );
	}
}

function post_list_render_callback( $block ) {
	
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-post_list.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-post_list.php") );
	}
}

function team_list_render_callback( $block ) {
	
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists( get_theme_file_path("/template-parts/block/content-team_list.php") ) ) {
		include( get_theme_file_path("/template-parts/block/content-team_list.php") );
	}
}
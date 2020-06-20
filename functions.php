<?php
add_action( 'after_setup_theme', 'ohfnext_setup' );
function ohfnext_setup() {
    load_theme_textdomain( 'ohfnext', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form' ) );

    add_theme_support( 'align-wide' );

    global $content_width;
    if ( ! isset( $content_width ) ) { $content_width = 1920; }

    register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'ohfnext' ) ) );

    add_theme_support('disable-custom-font-sizes');

    wp_register_style( 'ohfnext-blocks-style', get_template_directory_uri() . '/css/blocks.css' );

    // wp_register_style( 'ohfnext-blocks-style', get_template_directory_uri() . '/css/blocks.css' );
    // register_block_style(
    //     'core/paragraph',
    //     array(
    //         'name'         => 'bg-blue',
    //         'label'        => 'Blue background',
    //         'style_handle' => 'ohfnext-blocks-style'
    //     )
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
		]
    );

    add_theme_support( 'editor-gradient-presets' );
    add_theme_support( 'disable-custom-gradients' );

}

add_action( 'wp_enqueue_scripts', 'ohfnext_load_scripts' );
function ohfnext_load_scripts() {
    wp_enqueue_style( 'ohfnext-style', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
}

add_action( 'wp_footer', 'ohfnext_footer_scripts' );
function ohfnext_footer_scripts() {
    ?>
    <script>
    jQuery(document).ready(function ($) {
        var deviceAgent = navigator.userAgent.toLowerCase();
        if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
            $("html").addClass("ios");
            $("html").addClass("mobile");
        }
        if (navigator.userAgent.search("MSIE") >= 0) {
            $("html").addClass("ie");
        }
        else if (navigator.userAgent.search("Chrome") >= 0) {
            $("html").addClass("chrome");
        }
        else if (navigator.userAgent.search("Firefox") >= 0) {
            $("html").addClass("firefox");
        }
        else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
            $("html").addClass("safari");
        }
        else if (navigator.userAgent.search("Opera") >= 0) {
            $("html").addClass("opera");
        }
    });
    </script>
    <?php
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

add_action( 'widgets_init', 'ohfnext_widgets_init' );
function ohfnext_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Sidebar Widget Area', 'ohfnext' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

add_action( 'wp_head', 'ohfnext_pingback_header' );
function ohfnext_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}

add_action( 'comment_form_before', 'ohfnext_enqueue_comment_reply_script' );
function ohfnext_enqueue_comment_reply_script() {
    if ( get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function ohfnext_custom_pings( $comment ) {
    ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter( 'get_comments_number', 'ohfnext_comment_count', 0 );
function ohfnext_comment_count( $count ) {
    if ( ! is_admin() ) {
        global $id;
        $get_comments = get_comments( 'status=approve&post_id=' . $id );
        $comments_by_type = separate_comments( $get_comments );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}

// add_action( 'enqueue_block_editor_assets', 'ohfnext_enqueue' );
// function ohfnext_enqueue() {
//     wp_enqueue_script(
//         'ohfnext-blocks',
//         get_template_directory_uri() . '/js/blocks.js',
//         array( 'wp-blocks', 'wp-dom-ready' )
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
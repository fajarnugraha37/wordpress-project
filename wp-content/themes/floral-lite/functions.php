<?php
/**
 * Floral functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Floral
 */

/**
 * Determine whether it is an AMP response.
 *
 * This function is used as a "Conditional Tag" in WordPress. It can only be used at the `wp` action or later.
 *
 * @link https://developer.wordpress.org/themes/references/list-of-conditional-tags/
 * @see is_amp_endpoint()
 *
 * @return bool Is AMP response.
 */
function floral_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function floral_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Floral, use a find and replace
	 * to change 'floral-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'floral-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'floral-recent', 90, 90, true );
	add_image_size( 'floral-featured', 580, 386, true );
	set_post_thumbnail_size( 770, 500, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Header', 'floral-lite' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background', apply_filters(
			'floral_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support( 'custom-logo' );

	// Post format.
	add_theme_support(
		'post-formats',
		array(
			'video',
			'audio',
			'quote',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// AMP.
	add_theme_support(
		'amp',
		array(
			'paired' => true,
			/*
			 * Configure nav submenu toggles, per <https://amp-wp.org/documentation/playbooks/navigation-sub-menu-buttons/>.
			 * Note that Noto Simple does not make use of such buttons, using an older pattern used in core themes like
			 * Twenty Thirteen where a user must tap once on the parent nav menu item once to cause the submenu to appear;
			 * the user can then either tap on the parent nav menu item again to navigate to that page, or they can click
			 * on one of the revealed submenu items. In Twenty Fifteen, this pattern for mobile submenu navigation has been
			 * replaced by a more accessible method of adding submenu toggle buttons next to each parent item, allowing
			 * navigation to a parent nav menu item link without having to tap it twice. Because Noto Simple does not use
			 * these buttons, the style.css in the child theme has additional CSS to style the submenu toggle buttons when
			 * they appear on not just mobile but any touch interface.
			 */
			'nav_menu_dropdown' => array(
				'sub_menu_button_class'        => 'dropdown-toggle fa fa-angle-down',
				'sub_menu_button_toggle_class' => 'toggled-on',
			),
		)
	);
}
add_action( 'after_setup_theme', 'floral_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function floral_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'floral_content_width', 770 );
}
add_action( 'after_setup_theme', 'floral_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function floral_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'floral-lite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'floral-lite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	require_once get_template_directory() . '/inc/widgets/class-floral-recent-posts-widget.php';
	register_widget( 'Floral_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'floral_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function floral_scripts() {
	wp_enqueue_style( 'floral-fonts', floral_fonts_url() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', '', '4.5.0' );
	wp_enqueue_style( 'floral-style', get_stylesheet_uri() );

	if ( ! floral_is_amp() ) {
		wp_enqueue_script( 'floral-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
		wp_enqueue_script( 'floral-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

		wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), '1.6.0', true );
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array( 'jquery' ), '1.5.0', true );

		wp_enqueue_script(
			'floral-script', get_template_directory_uri() . '/js/script.js', array(
				'slick-js',
				'theia-sticky-sidebar',
			), '1.0', true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'floral_scripts' );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function floral_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'floral-lite' ) ) {
		$fonts[] = 'Playfair Display:400,400i,700,700i,900,900i';
	}
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'floral-lite' ) ) {
		$fonts[] = 'Open Sans:400,400i,700,700i';
	}

	$fonts_url = add_query_arg(
		array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		), 'https://fonts.googleapis.com/css'
	);

	return $fonts_url;
}

/**
 * Load Gutenberg stylesheet.
 */
function floral_style_editor_gutenberg() {
	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'floral-fonts', floral_fonts_url() );
	wp_enqueue_style( 'style-editor', get_theme_file_uri( '/style-editor.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'floral_style_editor_gutenberg' );


/**
 * Add editor style.
 */
function floral_add_editor_styles() {
	add_editor_style(
		array(
			'css/editor-style.css',
			floral_fonts_url(),
			get_template_directory_uri() . '/css/font-awesome.min.css',
		)
	);
}
add_action( 'init', 'floral_add_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM Activation Class.
 */
require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/admin/plugins.php';

/**
 * Load dashboard
 */
require get_template_directory() . '/inc/dashboard/class-floral-lite-dashboard.php';
$dashboard = new Floral_Lite_Dashboard();

require get_template_directory() . '/inc/customizer-pro/class-floral-lite-customizer-pro.php';
$customizer_pro = new Floral_Lite_Customizer_Pro();
$customizer_pro->init();

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

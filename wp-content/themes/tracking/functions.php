<?php
const TRACKING_VERSION = '1.0.0';

if ( ! function_exists( 'tracking_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tracking_setup() {
		/*
		 * Hide admin bar for all roles except administrator
		 * */
		if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
			show_admin_bar( false );
		}

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'top-menu' => esc_html__( 'Top Menu', 'imp' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'tracking_setup' );

function tracking_scripts_and_styles() {
	wp_enqueue_style( 'tracking-style', get_stylesheet_uri(), array(), TRACKING_VERSION );
}

add_action( 'wp_enqueue_scripts', 'tracking_scripts_and_styles' );

add_action( 'wp_head', 'tracking_head_service_worker' );
function tracking_head_service_worker() {
	?>
    <link rel="manifest" href="<?php echo esc_url( home_url( '/manifest.json' ) ); ?>">
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
                .register('/sw.js')
                .then(function () {
                    console.log("Service Worker Registered");
                });
        }
    </script>
	<?php
}

/*
 * Post types
 */
require get_template_directory() . '/inc/post-types.php';

/*
 * Tasks
 */
require get_template_directory() . '/inc/tasks.php';

/*
 * Auth
 */
require get_template_directory() . '/inc/auth.php';

/*
 * Users
 */
require get_template_directory() . '/inc/users.php';

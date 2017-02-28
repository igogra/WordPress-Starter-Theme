<?php
if (!function_exists('theme_setup')) {
	/**
	 * Set up theme defaults
	 */
	function theme_setup() {
		// Register nav menus
		register_nav_menus(array(
			'primary'   => 'Primary Menu',
			'secondary' => 'Secondary Menu'
			)
		);

		// Enable support for post thumbnails on posts and pages
		add_theme_support('post-thumbnails');

		// Clean up the head
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'wp_shortlink_wp_head');

		// Prevent file modifications
		if (!defined('DISALLOW_FILE_EDIT')) {
			define('DISALLOW_FILE_EDIT', true);
		}
	}
}
add_action('after_setup_theme', 'theme_setup');

/**
 * Enqueue scripts
 */
function theme_scripts() {
	if (is_admin()) {
		return;
	}

	// Styles
	wp_enqueue_style('main-style',  get_template_directory_uri() . '/css/dist/main.min.css');

	// Scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('main-script', get_template_directory_uri() . '/js/dist/main.min.js', array('jquery'));
	wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/dist/bootstrap.min.js', array('jquery'));
	wp_enqueue_script('lazyload-script', get_template_directory_uri() . '/js/dist/lazyload.min.js', array('jquery'));
	wp_enqueue_script('livereload', 'http://localhost:35729/livereload.js');
}
add_action('wp_enqueue_scripts', 'theme_scripts');

/**
 * Deregister styles
 */
function deregister_styles() {
	//wp_deregister_style('contact-form-7');
}
add_action('wp_print_styles', 'deregister_styles', 100);

/**
 * Deregister scripts
 */
function deregister_scripts() {
	/*wp_dequeue_script('contact-form-7');
	wp_deregister_script('contact-form-7');*/
}
add_action('wp_print_scripts', 'deregister_scripts', 100);

/**
 * Change the login logo
 */
function login_logo() {
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/dist/site-login-logo.png);
        }
    </style>
<?php
}
add_action('login_enqueue_scripts', 'login_logo');

/**
 * Change the url of the login logo
 * @return string The url of the login logo
 */
function login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'login_logo_url');

/**
 * Change the title of the login logo
 * @return string The title of the login logo
 */
function login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'login_logo_url_title');

/**
 * Hide admin areas that are not used
 */
function remove_menu_pages() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_menu_pages');

/**
 * Hide toolbar items
 * @param  object $wp_admin_bar The toolbar
 */
function remove_item_toolbar($wp_admin_bar) {
	$wp_admin_bar->remove_node('comments');
	$wp_admin_bar->remove_node('new-post');
}
add_action('admin_bar_menu', 'remove_item_toolbar', 999);

/**
 * Deregister heartbeat to solve CPU problems
 */
function deregister_heartbeat() {
	global $pagenow;

	if ('post.php' != $pagenow && 'post-new.php' != $pagenow) {
		wp_deregister_script('heartbeat');
	}
}
add_action('init', 'deregister_heartbeat', 1);

/**
 * Add active class to current menu item
 * @param  array $classes The classes of the menu item
 * @param  object $item   The menu item
 * @return array          The classes of the menu item
 */
function special_nav_class($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

/**
 * Customize the pagination HTML from the wp-pagenavi plugin
 * @param  string $html The pagination HTML
 * @return string       The pagination HTML
 */
function custom_pagination($html) {
    $out = '';
    $out = str_replace("<div", "", $html);
    $out = str_replace("class='wp-pagenavi'>", "", $out);
    $out = str_replace("<a", "<li><a", $out);
    $out = str_replace("</a>", "</a></li>", $out);
    $out = str_replace("<span class='current'", "<li class='active'><span", $out);
    $out = str_replace("<span class='pages'", "<li><span", $out);
    $out = str_replace("</span>", "</span></li>", $out);
    $out = str_replace("</div>", "", $out);

    return '<nav aria-label="Page navigation" class="text-center"><ul class="pagination">' . $out . '</ul></nav>';
}
add_filter('wp_pagenavi', 'custom_pagination', 10, 2);

// Disable default WordPress change password notifications
if (!function_exists('wp_password_change_notification')) {
    function wp_password_change_notification($user) {
    	return;
    }
}

require_once get_template_directory() . '/inc/aq_resizer.php';
?>

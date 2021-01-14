<?php

//enqueue styles and scripts
function enqueue_scripts_and_styles()
{
    //wp_enqueue_style('main-styles', get_template_directory_uri() . '/main.6d0790188d013fc0ec4a.css?84804736c1c56502fcab', array(), null, false);
    //wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js?84804736c1c56502fcab', array(), null, false);
    // wp_enqueue_style('main_style', get_template_directory_uri() . '/sass/main.css', array(), null, false);
    // wp_enqueue_script('main-js', get_template_directory_uri() . '/js/app.js', array(), null, false);

    wp_enqueue_style('main-styles', get_template_directory_uri() . '/main.274b5a58347e686811e2.css?992ea58f33094104179e', array(), null, false);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/main.js?992ea58f33094104179e', array(), null, false);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles');

//activate featured images
add_theme_support('post-thumbnails');

function add_title_tag()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'add_title_tag');


//register menus
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('main-menu'),
            'legal-menu' => __('legal-menu'),
            'social-menu' => __('social-menu')
        )
    );
}
add_action('init', 'register_my_menus');


//remove jquery
function remove_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }
}

//add_action('wp_enqueue_scripts', 'remove_jquery');


// REMOVE EMOJI ICONS
function disable_emoji_feature()
{

    // Prevent Emoji from loading on the front-end
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove from admin area also
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove from RSS feeds also
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    // Remove from Embeds
    remove_filter('embed_head', 'print_emoji_detection_script');

    // Remove from emails
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Disable from TinyMCE editor. Currently disabled in block editor by default
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');

    /** Finally, prevent character conversion too
     ** without this, emojis still work
     ** if it is available on the user's device
     */

    add_filter('option_use_smilies', '__return_false');
}

add_action('init', 'disable_emoji_feature');

// Remove emoji support
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');
// Remove the tinymce emoji plugin.
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
// Remove emoji CDN hostname from DNS prefetching hints.
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
        $urls = array_diff($urls, array($emoji_svg_url));
    }
    return $urls;
}

 //remove stuff for all non admins
 function remove_menus() {
	//remove_menu_page( 'index.php' ); //Dashboard
	//remove_menu_page( 'edit.php' ); //Posts
	//remove_menu_page( 'upload.php' ); //Media
	//remove_menu_page( 'edit.php?post_type=page' ); //Pages
	remove_menu_page( 'edit-comments.php' ); //Comments
	//remove_menu_page( 'themes.php' ); //Appearance
	//remove_menu_page( 'plugins.php' ); //Plugins
	remove_menu_page( 'users.php' ); //Users
	remove_menu_page( 'tools.php' ); //Tools
	//remove_menu_page( 'options-general.php' ); //Settings
   }
   add_action( 'admin_menu', 'remove_menus' );
/*

// adapt admin dashboard: submenus
function remove_submenus() {
 remove_submenu_page( 'themes.php', 'theme-editor.php' );
 remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
 remove_submenu_page( 'tools.php', 'tools.php' );
 remove_submenu_page( 'tools.php', 'import.php' );
 remove_submenu_page( 'options-general.php', 'optionsdiscussion.php' );
}
add_action( 'admin_menu', 'remove_submenus' ); */

// Remove unnecessary meta boxes
function wp_customize_default_meta_boxes()
{
    remove_meta_box('authordiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
    //remove_meta_box('postexcerpt', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
}
add_action('admin_init', 'wp_customize_default_meta_boxes');

// Adapt dashboard
function remove_dashboard_widgets()
{
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side'); //WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // Other WordPress News
    // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function wp_init()
{
    add_theme_support('post-thumbnails');
    remove_theme_support('comments');
    remove_post_type_support('post', 'post-formats');
    remove_post_type_support('post', 'comments');
    remove_post_type_support('post', 'trackbacks');
    remove_post_type_support('page', 'custom-fields');
    remove_post_type_support('page', 'comments');
    remove_post_type_support('page', 'author');
    remove_post_type_support('page', 'trackbacks');

    // Remove roles
    remove_role('subscriber');
    remove_role('editor');
    remove_role('contributor');
    // Put scripts before the closing body tag
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);

    // Remove feed links from head section
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_resource_hints', 2);
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_generator');
}

add_action('init', 'wp_init');

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
    $timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
        }
    );

    add_filter(
        'template_include',
        function ($template) {
            return get_stylesheet_directory() . '/static/no-timber.html';
        }
    );
    return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
    /** Add timber support. */
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'theme_supports'));
        add_filter('timber/context', array($this, 'add_to_context'));
        add_filter('timber/twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }
    /** This is where you can register custom post types. */
    public function register_post_types()
    {
    }
    /** This is where you can register custom taxonomies. */
    public function register_taxonomies()
    {
    }


    /** This is where you add some context
     *
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context($context)
    {
        $context['legalmenu']  = new Timber\Menu("legal-menu");
        $context['mainmenu']  = new Timber\Menu("main-menu");
        $context['socialmenu']  = new Timber\Menu("social-menu");
        $context['services'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'services', 'order' => 'ASC']);
        $context['gigs'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'gigs', 'posts_per_page' => 3]);
        $context['latestnews'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'news', 'posts_per_page' => 3]);
        $context['news'] = Timber::get_posts(['post_type' => 'post', 'category_name' => 'news']);
        $context['frontpage'] = Timber::get_post(get_option("page_on_front"));
        $context['site']  = $this;
        return $context;
    }

    public function theme_supports()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            )
        );

        add_theme_support('menus');
    }

    /** This Would return 'foo bar!'.
     *
     * @param string $text being 'foo', then returned 'foo bar!'.
     */
    public function myfoo($text)
    {
        $text .= ' bar!';
        return $text;
    }

    /** This is where you can add your own functions to twig.
     *
     * @param string $twig get extension.
     */
    public function add_to_twig($twig)
    {
        $twig->addExtension(new Twig\Extension\StringLoaderExtension());
        $twig->addFilter(new Twig\TwigFilter('myfoo', array($this, 'myfoo')));
        return $twig;
    }
}

new StarterSite();

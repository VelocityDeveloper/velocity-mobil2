<?php
/**
 * Fuction yang digunakan di theme ini.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_action( 'after_setup_theme', 'velocitychild_theme_setup', 9 );

function velocitychild_theme_setup() {
	
	// Load justg_child_enqueue_parent_style after theme setup
	add_action( 'wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20 );
	
    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');

    //Inisialisasi theme child
    add_action('tgmpa_register', 'recmetabox_plugins');
}

///remove breadcrumbs
add_action('wp_head', function () {
	if (!is_single()) {
		remove_action('justg_before_title', 'justg_breadcrumb');
	}
});

if (!function_exists('justg_header_open')) {
	function justg_header_open()
	{
		echo '<header id="wrapper-header">';
		echo '<div id="wrapper-navbar" class="px-0" itemscope itemtype="http://schema.org/WebSite">';
	}
}
if (!function_exists('justg_header_close')) {
	function justg_header_close()
	{
		echo '</div>';
		echo '</header>';
	}
}


///add action builder part
add_action('justg_header', 'justg_header_mobil');
function justg_header_mobil()
{
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_mobil');
function justg_footer_mobil() {
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}
add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
function justg_before_wrapper_content() {
	echo '<div class="card rounded-0 border-0 px-0 container">';
}
add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
function justg_after_wrapper_content() {
	echo '</div>';
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Right sidebar check
     * 
     */
    function justg_right_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');

        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }

        if ('right' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar') && !has_action('justg_before_main_sidebar') && !has_action('justg_after_main_sidebar')) {
                return;
            }

        ?>
            <div class="widget-area right-sidebar col-sm-4 order-3" id="right-sidebar" role="complementary">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
            <?php
        }
    }
}

function velocitytoko_display_recaptcha() {

    echo '<div class="velocitytoko-recaptcha my-2">';
        if (class_exists('Velocity_Addons_Captcha')){
            $captcha = new Velocity_Addons_Captcha;
            $captcha->display();
        }
    echo '</div>';

}

function velocitytoko_validate_recaptcha() {
    if (class_exists('Velocity_Addons_Captcha')) {
        $captcha = new Velocity_Addons_Captcha();
        $verify = $captcha->verify();
        
        if (!$verify['success']) {
            return $verify['message'];
        }
    }
    
    return true;
}

add_action('wp_head','velocity_ajaxurl');
function velocity_ajaxurl() {
    $html    = '<script type="text/javascript">';
    $html   .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
    $html   .= '</script>';
    echo $html;
}
//register product template
add_filter( 'template_include', 'velocity_register_produk_template' );
function velocity_register_produk_template( $template ) {    
    if ( is_singular('produk') ) {
        $template = get_stylesheet_directory() . '/single-produk.php';
    }
    if ( is_post_type_archive('produk') || is_tax('kategori-produk') ) {
        $template = get_stylesheet_directory() . '/archive-produk.php';
    }
    return $template;
}
function vdberita_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function recmetabox_plugins() {
    $plugins = array(
        // Include Metabox plugin
        array(
            'name'     => 'Metabox',
            'slug'     => 'meta-box',
            'required' => true,
        ),
        // Tambahkan plugin wajib lainnya di sini
    );
    $config = array(
        'id'           => 'tgmpa',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}
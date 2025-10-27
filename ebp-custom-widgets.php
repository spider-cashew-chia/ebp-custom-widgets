<?php
/**
 * Plugin Name: EBP Custom Widgets
 * Description: Custom Elementor widgets for e-blueprint digital.
 * Version: 2.0
 * Author: e-blueprint digital
 */

if (!defined('ABSPATH'))
    exit;

// Register custom category with very early priority
function add_ebp_custom_widgets_category($elements_manager)
{
    $elements_manager->add_category(
        'ebp-custom-widgets',
        [
            'title' => __('EBP Custom Widgets', 'ebp-custom-widgets'),
            'icon' => 'fa fa-star',
        ],
        1 // Position at the top
    );
}
add_action('elementor/elements/categories_registered', 'add_ebp_custom_widgets_category', 1);



// custom hero 1
function register_ebp_custom_hero_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-hero-1/ebp-custom-hero-1.php');
    $widgets_manager->register(new \Ebp_Custom_Hero_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_hero_1');



// text block 3
function register_ebp_custom_text_block_3($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-text-block-3/ebp-custom-text-block-3.php');
    $widgets_manager->register(new \Ebp_Custom_Text_Block_3());
}
add_action('elementor/widgets/register', 'register_ebp_custom_text_block_3');

// text block 1
function register_ebp_custom_text_block_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-text-block-1/ebp-custom-text-block-1.php');
    $widgets_manager->register(new \Ebp_Custom_Text_Block_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_text_block_1');

// custom header 1
function register_ebp_custom_header_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-header-1/ebp-custom-header-1.php');
    $widgets_manager->register(new \Ebp_Custom_Header_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_header_1');



// accordion 1
function register_ebp_custom_accordion_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-accordion-1/ebp-custom-accordion-1.php');
    $widgets_manager->register(new \Ebp_Custom_Accordion_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_accordion_1');

// footer 1
function register_ebp_custom_footer_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-footer-1/ebp-custom-footer-1.php');
    $widgets_manager->register(new \Ebp_Custom_Footer_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_footer_1');



// contact 2
function register_ebp_custom_contact_2($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-contact-2/ebp-custom-contact-2.php');
    $widgets_manager->register(new \Ebp_Custom_Contact_2());
}
add_action('elementor/widgets/register', 'register_ebp_custom_contact_2');

// quote 1
function register_ebp_custom_quote_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-quote-1/ebp-custom-quote-1.php');
    $widgets_manager->register(new \Ebp_Custom_Quote_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_quote_1');

// services 1
function register_ebp_custom_services_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-services-1/ebp-custom-services-1.php');
    $widgets_manager->register(new \Ebp_Custom_Services_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_services_1');

// map
function register_ebp_custom_map_1($widgets_manager)
{
    require_once(__DIR__ . '/widgets/ebp-custom-map-1/ebp-custom-map-1.php');
    $widgets_manager->register(new \Ebp_Custom_Map_1());
}
add_action('elementor/widgets/register', 'register_ebp_custom_map_1');






// Enqueue widget assets only on frontend
function my_widget_assets()
{
    // Only load on frontend, not in admin or Elementor editor
    if (is_admin() || (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->editor->is_edit_mode())) {
        return;
    }

    // Global assets
    wp_enqueue_script('bootstrap-js', plugins_url('/assets/bootstrap.js', __FILE__));
    wp_enqueue_style('bootstrap', plugins_url('/assets/bootstrap.css', __FILE__));
    wp_enqueue_style('swiper-css', plugins_url('/assets/swiper.css', __FILE__));
    wp_enqueue_style('global-css', plugins_url('/assets/global.css', __FILE__));
    wp_enqueue_script('swiper-js', plugins_url('/assets/swiper.js', __FILE__), [], false, true);
    // aos css
    wp_enqueue_style('aos-css', plugins_url('/assets/aos.css', __FILE__));
    // aos js
    wp_enqueue_script('aos-js', plugins_url('/assets/aos.js', __FILE__), [], false, true);

    // gsap
    wp_enqueue_script('gsap-js', plugins_url('/assets/gsap.min.js', __FILE__), [], false, true);
    // gsap tools
    wp_enqueue_script('gsap-tools-js', plugins_url('/assets/GSDevTools.min.js', __FILE__), [], false, true);


    // scroll trigger
    wp_enqueue_script('gsap-scrolltrigger-js', plugins_url('/assets/ScrollTrigger.min.js', __FILE__), [], false, true);

    // split text
    wp_enqueue_script('gsap-splittext-js', plugins_url('/assets/SplitText.min.js', __FILE__), [], false, true);

    // main js
    wp_enqueue_script('main-js', plugins_url('/assets/main.js', __FILE__), [], false, true);

    // Individual widget assets
    // hero 1
    wp_enqueue_style('ebp-custom-hero-1-style', plugins_url('/widgets/ebp-custom-hero-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-hero-1-script', plugins_url('/widgets/ebp-custom-hero-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);


    // text block 3
    wp_enqueue_style('ebp-custom-text-block-3-style', plugins_url('/widgets/ebp-custom-text-block-3/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-text-block-3-script', plugins_url('/widgets/ebp-custom-text-block-3/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);

    // text block 1
    wp_enqueue_style('ebp-custom-text-block-1-style', plugins_url('/widgets/ebp-custom-text-block-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-text-block-1-script', plugins_url('/widgets/ebp-custom-text-block-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);

    // header 1
    wp_enqueue_style('ebp-custom-header-1-style', plugins_url('/widgets/ebp-custom-header-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-header-1-script', plugins_url('/widgets/ebp-custom-header-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);



    // accordion 1
    wp_enqueue_style('ebp-custom-accordion-1-style', plugins_url('/widgets/ebp-custom-accordion-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-accordion-1-script', plugins_url('/widgets/ebp-custom-accordion-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);

    // footer 1
    wp_enqueue_style('ebp-custom-footer-1-style', plugins_url('/widgets/ebp-custom-footer-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-footer-1-script', plugins_url('/widgets/ebp-custom-footer-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);



    // contact 2
    wp_enqueue_style('ebp-custom-contact-2-style', plugins_url('/widgets/ebp-custom-contact-2/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-contact-2-script', plugins_url('/widgets/ebp-custom-contact-2/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);


    // quote 1
    wp_enqueue_style('ebp-custom-quote-1-style', plugins_url('/widgets/ebp-custom-quote-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-quote-1-script', plugins_url('/widgets/ebp-custom-quote-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);

    // services 1
    wp_enqueue_style('ebp-custom-services-1-style', plugins_url('/widgets/ebp-custom-services-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-services-1-script', plugins_url('/widgets/ebp-custom-services-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);

    // map
    wp_enqueue_style('ebp-custom-map-1-style', plugins_url('/widgets/ebp-custom-map-1/assets/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('ebp-custom-map-1-script', plugins_url('/widgets/ebp-custom-map-1/assets/script.js', __FILE__), ['jquery'], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'my_widget_assets');

// Add loading animation to page head - because we need it there from the start
function add_loading_animation_to_head()
{
    // Only add on frontend, not in admin or Elementor editor
    if (is_admin() || (defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->editor->is_edit_mode())) {
        return;
    }
    ?>
<!-- <div id="ebp-loading-overlay">
        <div class="ebp-loading-content"></div>
    </div> -->
<?php
}
add_action('wp_head', 'add_loading_animation_to_head', 1);
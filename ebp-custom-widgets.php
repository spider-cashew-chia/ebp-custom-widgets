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



// Automatically register all widgets from the widgets directory
function register_all_ebp_custom_widgets($widgets_manager)
{
    // Get the widgets directory path
    $widgets_dir = __DIR__ . '/widgets';

    // Check if the directory exists
    if (!is_dir($widgets_dir)) {
        return;
    }

    // Scan the widgets directory for all widget folders
    $widget_folders = array_filter(glob($widgets_dir . '/*'), 'is_dir');

    // Loop through each widget folder
    foreach ($widget_folders as $widget_folder) {
        // Get the folder name (e.g., "ebp-custom-hero-1")
        $folder_name = basename($widget_folder);

        // Construct the PHP file path
        $widget_file = $widget_folder . '/' . $folder_name . '.php';

        // Check if the widget file exists
        if (!file_exists($widget_file)) {
            continue;
        }

        // Convert folder name to class name
        // Example: "ebp-custom-hero-1" -> "Ebp_Custom_Hero_1"
        $class_name = convert_folder_to_class_name($folder_name);

        // Require the widget file
        require_once($widget_file);

        // Check if the class exists before trying to instantiate it
        if (class_exists($class_name)) {
            // Register the widget
            $widgets_manager->register(new $class_name());
        }
    }
}
add_action('elementor/widgets/register', 'register_all_ebp_custom_widgets');

// Helper function to convert folder name to class name
// Example: "ebp-custom-hero-1" -> "Ebp_Custom_Hero_1"
function convert_folder_to_class_name($folder_name)
{
    // Remove the "ebp-custom-" prefix
    $name_without_prefix = str_replace('ebp-custom-', '', $folder_name);

    // Split by hyphens
    $parts = explode('-', $name_without_prefix);

    // Capitalize each part and join with underscores
    $capitalized_parts = array_map('ucfirst', $parts);
    $class_suffix = implode('_', $capitalized_parts);

    // Return the full class name
    return 'Ebp_Custom_' . $class_suffix;
}






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

    // Automatically enqueue assets for all widgets
    $widgets_dir = __DIR__ . '/widgets';

    // Check if the directory exists
    if (is_dir($widgets_dir)) {
        // Scan the widgets directory for all widget folders
        $widget_folders = array_filter(glob($widgets_dir . '/*'), 'is_dir');

        // Loop through each widget folder
        foreach ($widget_folders as $widget_folder) {
            // Get the folder name (e.g., "ebp-custom-hero-1")
            $folder_name = basename($widget_folder);

            // Construct asset file paths
            $style_file = $widget_folder . '/assets/style.css';
            $script_file = $widget_folder . '/assets/script.js';

            // Enqueue CSS if it exists
            if (file_exists($style_file)) {
                wp_enqueue_style(
                    $folder_name . '-style',
                    plugins_url('/widgets/' . $folder_name . '/assets/style.css', __FILE__),
                    [],
                    '1.0.0'
                );
            }

            // Enqueue JS if it exists
            if (file_exists($script_file)) {
                wp_enqueue_script(
                    $folder_name . '-script',
                    plugins_url('/widgets/' . $folder_name . '/assets/script.js', __FILE__),
                    ['jquery'],
                    '1.0.0',
                    true
                );
            }
        }
    }
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
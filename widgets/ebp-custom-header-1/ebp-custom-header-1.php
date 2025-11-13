<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

// Custom walker class to match the existing menu structure
// This class must be defined outside of the widget class
class Ebp_Custom_Menu_Walker extends Walker_Nav_Menu
{
    private $submenu_counter = 0;

    // Start the list element
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $this->submenu_counter++;
        $submenu_id = 'submenu-' . $this->submenu_counter;

        // Check if this is a nested submenu (depth > 0 means it's inside another submenu)
        if ($depth > 0) {
            $output .= "\n$indent<ul class=\"sub-menu shape-none\" id=\"$submenu_id\">\n";
        } else {
            $output .= "\n$indent<ul class=\"sub-menu\" id=\"$submenu_id\">\n";
        }
    }

    // End the list element
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // Start each menu item
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Get classes for the menu item
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if item has children
        $has_children = in_array('menu-item-has-children', $classes);

        // Build class string
        if ($depth === 0) {
            // Top level items
            $class_names = 'nav-item';
            if ($has_children) {
                $class_names .= ' nav-item-has-children';
            }
        } else {
            // Submenu items
            $class_names = 'sub-menu--item';
            if ($has_children) {
                $class_names .= ' nav-item-has-children';
            }
        }

        // Build the link attributes
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

        // Determine link class and href
        if ($depth === 0) {
            // Top level items
            $link_class = 'nav-link-item';
            if ($has_children) {
                $link_class .= ' drop-trigger';
                // Items with children use # as href
                $href = ' href="#"';
            } else {
                // Items without children use their actual URL
                $href = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : ' href="#"';
            }
        } else {
            // Submenu items
            if ($has_children) {
                $link_class = 'drop-trigger';
                $attributes .= ' data-menu-get="h3"';
                // Submenu items with children use # as href
                $href = ' href="#"';
            } else {
                $link_class = '';
                // Submenu items without children use their actual URL
                $href = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : ' href="#"';
            }
        }

        $item_output = '';

        // Start the list item
        $output .= $indent . '<li class="' . esc_attr($class_names) . '">';

        // Build the anchor tag
        $item_output .= '<a class="' . esc_attr($link_class) . '"' . $href . $attributes . '>';

        // Add menu item text wrapped in span for submenu items
        if ($depth > 0) {
            $item_output .= '<span class="menu-item-text">' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
        } else {
            $item_output .= apply_filters('the_title', $item->title, $item->ID);
        }

        // Add dropdown icon if item has children
        if ($has_children) {
            $item_output .= ' <i class="fas fa-angle-down"></i>';
        }

        $item_output .= '</a>';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // End each menu item
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

class Ebp_Custom_Header_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_header_1';
    }

    public function get_title()
    {
        return __('EBP Custom Header 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-header';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-header-1-style'];
    }


    protected function register_controls()
    {
        // Logo Section
        $this->start_controls_section(
            'logo_section',
            [
                'label' => __('Logo', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Logo Image Control
        $this->add_control(
            'logo_image',
            [
                'label' => __('Logo Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'description' => __('Upload your logo image', 'ebp-custom-widgets'),
            ]
        );

        // Logo Link Control
        $this->add_control(
            'logo_link',
            [
                'label' => __('Logo Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'default' => [
                    'url' => home_url('/'),
                ],
                'description' => __('Set the URL where the logo should link to', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Header Button Section
        $this->start_controls_section(
            'header_button_section',
            [
                'label' => __('Header Button', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Show/Hide Button Toggle
        $this->add_control(
            'show_header_button',
            [
                'label' => __('Show Header Button', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ebp-custom-widgets'),
                'label_off' => __('No', 'ebp-custom-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Button Text Control
        $this->add_control(
            'header_button_text',
            [
                'label' => __('Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Contact Us', 'ebp-custom-widgets'),
                'placeholder' => __('Enter button text', 'ebp-custom-widgets'),
                'condition' => [
                    'show_header_button' => 'yes',
                ],
            ]
        );

        // Button Link Control
        $this->add_control(
            'header_button_link',
            [
                'label' => __('Button Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'show_header_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        ?>
<header class="site-header aximo-header-section aximo-header1 dark-bg" id="sticky-menu">
    <div class="container">
        <nav class="navbar site-navbar">
            <!-- Brand Logo-->
            <?php
                    // Get logo settings from controls
                    $logo_image = $this->get_settings_for_display('logo_image');
                    $logo_link = $this->get_settings_for_display('logo_link');

                    // Default logo link to home URL if not set
                    $logo_url = !empty($logo_link['url']) ? esc_url($logo_link['url']) : esc_url(home_url('/'));
                    $logo_target = !empty($logo_link['is_external']) ? ' target="_blank"' : '';
                    $logo_nofollow = !empty($logo_link['nofollow']) ? ' rel="nofollow"' : '';

                    // Only show logo if image is set
                    if (!empty($logo_image['url'])):
                        ?>
            <div class="brand-logo">
                <a href="<?php echo $logo_url; ?>" <?php echo $logo_target . $logo_nofollow; ?>>
                    <img src="<?php echo esc_url($logo_image['url']); ?>"
                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="light-version-logo">
                </a>
            </div>
            <?php endif; ?>
            <div class="menu-block-wrapper">
                <div class="menu-overlay"></div>
                <nav class="menu-block" id="append-menu-header">
                    <div class="mobile-menu-head">
                        <div class="go-back">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="current-menu-title"></div>
                        <div class="mobile-menu-close">&times;</div>
                    </div>
                    <?php
                            // Display the WordPress menu using the custom walker
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'site-menu-main',
                                'container' => false,
                                'walker' => new Ebp_Custom_Menu_Walker(),
                                'fallback_cb' => function () {
                                    echo '<ul class="site-menu-main"><li class="nav-item"><a href="' . esc_url(home_url('/')) . '" class="nav-link-item">' . __('Home', 'ebp-custom-widgets') . '</a></li></ul>';
                                }
                            ));
                            ?>
                </nav>
            </div>

            <?php
                    // Get header button settings from controls
                    $show_button = $this->get_settings_for_display('show_header_button');
                    $button_text = $this->get_settings_for_display('header_button_text');
                    $button_link = $this->get_settings_for_display('header_button_link');

                    // Only show button if enabled and text is set
                    if ($show_button === 'yes' && !empty($button_text)):
                        // Get button link URL, default to # if not set
                        $button_url = !empty($button_link['url']) ? esc_url($button_link['url']) : '#';
                        $button_target = !empty($button_link['is_external']) ? ' target="_blank"' : '';
                        $button_nofollow = !empty($button_link['nofollow']) ? ' rel="nofollow"' : '';
                        ?>
            <div class="header-btn header-btn-l1 ms-auto d-none d-xs-inline-flex">
                <a class="aximo-default-btn pill aximo-header-btn" href="<?php echo $button_url; ?>"
                    <?php echo $button_target . $button_nofollow; ?>>
                    <?php echo esc_html($button_text); ?>
                </a>
            </div>
            <?php endif; ?>
            <!-- mobile menu trigger -->
            <div class="mobile-menu-trigger light">
                <span></span>
            </div>
            <!--/.Mobile Menu Hamburger Ends-->
        </nav>
    </div>
</header>
<!--End landex-header-section -->

<?php
    }
}
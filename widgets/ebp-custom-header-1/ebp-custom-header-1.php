<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

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
        // Header icon
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
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Header Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Logo
        $this->add_control(
            'header_logo',
            [
                'label' => __('Logo', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Logo Link
        $this->add_control(
            'logo_link',
            [
                'label' => __('Logo Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-site.com', 'ebp-custom-widgets'),
            ]
        );

        // Navigation Menu
        $this->add_control(
            'nav_menu',
            [
                'label' => __('Navigation Menu', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_nav_menus(),
                'default' => '',
            ]
        );

        // CTA Button Text
        $this->add_control(
            'cta_text',
            [
                'label' => __('CTA Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Get Started', 'ebp-custom-widgets'),
            ]
        );

        // CTA Button Link
        $this->add_control(
            'cta_link',
            [
                'label' => __('CTA Button Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
            ]
        );

        // Contact Email
        $this->add_control(
            'contact_email',
            [
                'label' => __('Contact Email', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('mail@example.co.uk', 'ebp-custom-widgets'),
            ]
        );

        // Contact Phone
        $this->add_control(
            'contact_phone',
            [
                'label' => __('Contact Phone', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('07123456789', 'ebp-custom-widgets'),
            ]
        );

        // Side CTA Link Text
        $this->add_control(
            'side_cta_text',
            [
                'label' => __('Side CTA Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Contact Us', 'ebp-custom-widgets'),
                'description' => __('Text displayed for the side CTA link', 'ebp-custom-widgets'),
            ]
        );

        // Side CTA Link
        $this->add_control(
            'side_cta_link',
            [
                'label' => __('Side CTA Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'description' => __('Link URL for the side CTA button', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Header Styles', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Header Background Color
        $this->add_control(
            'header_background_color',
            [
                'label' => __('Header Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-header-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Header Text Color
        $this->add_control(
            'header_text_color',
            [
                'label' => __('Header Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-header-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        // CTA Button Background Color
        $this->add_control(
            'cta_background_color',
            [
                'label' => __('CTA Button Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#007cba',
                'selectors' => [
                    '{{WRAPPER}} .header-cta-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // CTA Button Text Color
        $this->add_control(
            'cta_text_color',
            [
                'label' => __('CTA Button Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .header-cta-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Helper function to get navigation menus
    private function get_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $options = ['' => __('Select Menu', 'ebp-custom-widgets')];
        
        foreach ($menus as $menu) {
            $options[$menu->term_id] = $menu->name;
        }
        
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
<div class="ebp-custom-header-1">
    <nav class="navbar navbar-expand-lg navbar-sticky navbar-dark">
        <div class="container">
            <div class="site-branding">
                <!-- Logo -->
                <div class="col-auto">
                    <?php if (!empty($settings['logo_link']['url'])): ?>
                    <a href="<?php echo esc_url($settings['logo_link']['url']); ?>"
                        <?php echo $settings['logo_link']['is_external'] ? 'target="_blank"' : ''; ?>
                        <?php echo $settings['logo_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                        <?php endif; ?>

                        <?php if (!empty($settings['header_logo']['url'])): ?>
                        <img src="<?php echo esc_url($settings['header_logo']['url']); ?>" alt="Logo"
                            class="header-logo">
                        <?php endif; ?>

                        <?php if (!empty($settings['logo_link']['url'])): ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div><!-- .site-branding -->

            <div class="header-right gap-3 text-white d-flex align-items-center sg">
                <!-- Contact Email -->
                <?php if (!empty($settings['contact_email'])): ?>
                <a href="mailto:<?php echo esc_attr($settings['contact_email']); ?>"
                    class="header-email d-none d-sm-inline-block">
                    e: <?php echo esc_html($settings['contact_email']); ?>
                </a>
                <?php endif; ?>

                <!-- Contact Phone -->
                <?php if (!empty($settings['contact_phone'])): ?>
                <a href="tel:+44<?php echo esc_attr($settings['contact_phone']); ?>"
                    class="nav-link d-none d-sm-inline-block">
                    t: <?php echo esc_html($settings['contact_phone']); ?>
                </a>
                <?php endif; ?>

                <ul class="navbar-nav navbar-nav-secondary order-lg-3">
                    <li class="nav-item" data-bs-toggle="offcanvas" href="#offcanvasNav" role="button"
                        aria-controls="offcanvasNav" aria-label="button" tabindex="0">
                        <span class="nav-line" role="none"></span>
                        <span class="nav-line" role="none"></span>
                        <span class="nav-line" role="none"></span>
                        <!-- <a class="nav-link nav-icon" data-bs-toggle="offcanvas" href="#offcanvasNav"
role="button" aria-controls="offcanvasNav">
<span class="bi bi-list"></span>
</a> -->
                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
        <div class="offcanvas-header text-black">
            <!-- <h5 class="offcanvas-title" id="offcanvasNavLabel">Menu</h5> -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <!-- <i class="bi bi-x"></i> -->
            </button>
        </div>
        <div class="offcanvas-body text-black">
            <?php
            // Use the selected menu from widget settings
            if (!empty($settings['nav_menu'])) {
                wp_nav_menu(array(
                    'menu' => $settings['nav_menu'],
                    'container' => false,
                    'menu_class' => 'navbar-nav',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="toc-nav" class="ms-0 nav nav-minimal">%3$s</ul>',
                    'depth' => 2
                ));
            } else {
                // Fallback to theme location if no menu selected
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'container' => false,
                    'menu_class' => 'navbar-nav',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="toc-nav" class="ms-0 nav nav-minimal">%3$s</ul>',
                    'depth' => 2
                ));
            }
            ?>
        </div>
        <!-- <div class="offcanvas-footer border-top py-3 mt-3">



        </div> -->
    </div>

    <div class="side-cta">
        <div class="side-cta--container">
            <div class="side-cta--link">
                <?php if (!empty($settings['side_cta_text']) && !empty($settings['side_cta_link']['url'])): ?>
                <a href="<?php echo esc_url($settings['side_cta_link']['url']); ?>"
                    <?php echo $settings['side_cta_link']['is_external'] ? 'target="_blank"' : ''; ?>
                    <?php echo $settings['side_cta_link']['nofollow'] ? 'rel="nofollow"' : ''; ?> class="side-cta-link">
                    <?php echo esc_html($settings['side_cta_text']); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>



</div>
<?php
    }
}
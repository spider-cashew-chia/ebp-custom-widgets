<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Footer_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_footer_1';
    }

    public function get_title()
    {
        return __('EBP Custom Footer 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {
        // Footer icon
        return 'eicon-footer';
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
        return ['ebp-custom-footer-1-style'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Footer Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Footer Logo
        $this->add_control(
            'footer_logo',
            [
                'label' => __('Footer Logo', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Footer Logo Link
        $this->add_control(
            'footer_logo_link',
            [
                'label' => __('Footer Logo Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-site.com', 'ebp-custom-widgets'),
            ]
        );

        // Footer Columns Repeater
        $repeater = new \Elementor\Repeater();

        // Column Type
        $repeater->add_control(
            'column_type',
            [
                'label' => __('Column Type', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'menu',
                'options' => [
                    'menu' => __('Menu', 'ebp-custom-widgets'),
                    'text' => __('Text Block', 'ebp-custom-widgets'),
                    'image' => __('Image', 'ebp-custom-widgets'),
                ],
            ]
        );

        // Column Title
        $repeater->add_control(
            'column_title',
            [
                'label' => __('Column Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Column Title', 'ebp-custom-widgets'),
                'condition' => [
                    'column_type!' => 'image',
                ],
            ]
        );

        // Menu Selection
        $repeater->add_control(
            'nav_menu',
            [
                'label' => __('Select Menu', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_nav_menus(),
                'default' => '',
                'condition' => [
                    'column_type' => 'menu',
                ],
            ]
        );

        // Text Content
        $repeater->add_control(
            'text_content',
            [
                'label' => __('Text Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Add your text content here...', 'ebp-custom-widgets'),
                'condition' => [
                    'column_type' => 'text',
                ],
            ]
        );

        // Image
        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'column_type' => 'image',
                ],
            ]
        );

        // Image Link
        $repeater->add_control(
            'image_link',
            [
                'label' => __('Image Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'condition' => [
                    'column_type' => 'image',
                ],
            ]
        );

        // Social Media Icons Checkbox
        $repeater->add_control(
            'show_social_icons',
            [
                'label' => __('Show Social Media Icons', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ebp-custom-widgets'),
                'label_off' => __('No', 'ebp-custom-widgets'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Social Media Icons Repeater
        $social_repeater = new \Elementor\Repeater();
        
        // Social Media Icon
        $social_repeater->add_control(
            'social_icon',
            [
                'label' => __('Social Media Icon', 'ebp-custom-widgets'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'facebook-f',
                        'twitter',
                        'instagram',
                        'linkedin-in',
                        'youtube',
                        'pinterest',
                        'tiktok',
                        'snapchat-ghost',
                        'whatsapp',
                        'telegram-plane',
                    ],
                ],
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        // Social Media Link
        $social_repeater->add_control(
            'social_link',
            [
                'label' => __('Social Media Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-social-link.com', 'ebp-custom-widgets'),
            ]
        );

        // Add Social Media Repeater
        $repeater->add_control(
            'social_media_icons',
            [
                'label' => __('Social Media Icons', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $social_repeater->get_controls(),
                'default' => [
                    [
                        'social_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => ['url' => '#'],
                    ],
                    [
                        'social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'social_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ social_icon }}}',
                'condition' => [
                    'show_social_icons' => 'yes',
                ],
            ]
        );

        // Add Repeater
        $this->add_control(
            'footer_columns',
            [
                'label' => __('Footer Columns', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'column_type' => 'menu',
                        'column_title' => __('Quick Links', 'ebp-custom-widgets'),
                    ],
                    [
                        'column_type' => 'text',
                        'column_title' => __('About Us', 'ebp-custom-widgets'),
                        'text_content' => __('Add your company information here...', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ column_title }}}',
            ]
        );

        // Copyright Section
        $this->add_control(
            'show_copyright',
            [
                'label' => __('Show Copyright Section', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'ebp-custom-widgets'),
                'label_off' => __('No', 'ebp-custom-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Copyright Content
        $this->add_control(
            'copyright_content',
            [
                'label' => __('Copyright Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('© 2024 Your Company Name. All rights reserved.', 'ebp-custom-widgets'),
                'condition' => [
                    'show_copyright' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Footer Styles', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Footer Background Color
        $this->add_control(
            'footer_background_color',
            [
                'label' => __('Footer Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2c3e50',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-footer-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Footer Text Color
        $this->add_control(
            'footer_text_color',
            [
                'label' => __('Footer Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-footer-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Footer Link Color
        $this->add_control(
            'footer_link_color',
            [
                'label' => __('Footer Link Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3498db',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-footer-1 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Footer Link Hover Color
        $this->add_control(
            'footer_link_hover_color',
            [
                'label' => __('Footer Link Hover Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2980b9',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-footer-1 a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Column Title Color
        $this->add_control(
            'column_title_color',
            [
                'label' => __('Column Title Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .footer-column-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Footer Padding
        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => __('Footer Padding', 'ebp-custom-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '60',
                    'right' => '0',
                    'bottom' => '60',
                    'left' => '0',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-footer-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
<div class="ebp-custom-footer-1">
    <div class="container">
        <!-- Footer Logo Section -->
        <?php if (!empty($settings['footer_logo']['url'])): ?>
        <div class="footer-logo-section">
            <?php if (!empty($settings['footer_logo_link']['url'])): ?>
            <a href="<?php echo esc_url($settings['footer_logo_link']['url']); ?>"
                <?php echo $settings['footer_logo_link']['is_external'] ? 'target="_blank"' : ''; ?>
                <?php echo $settings['footer_logo_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                <?php endif; ?>
                <img src="<?php echo esc_url($settings['footer_logo']['url']); ?>" alt="Footer Logo"
                    class="footer-logo">
                <?php if (!empty($settings['footer_logo_link']['url'])): ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Footer Columns -->
        <?php if (!empty($settings['footer_columns'])): ?>
        <div class="footer-columns">
            <div class="row">
                <?php foreach ($settings['footer_columns'] as $index => $column): ?>
                <div class="col-md-4 col-lg-3 footer-column">
                    <div class="footer-column-content">
                        <!-- Column Title -->
                        <?php if (!empty($column['column_title']) && $column['column_type'] !== 'image'): ?>
                        <h4 class="footer-column-title"><?php echo esc_html($column['column_title']); ?></h4>
                        <?php endif; ?>

                        <!-- Column Content based on type -->
                        <?php if ($column['column_type'] === 'menu' && !empty($column['nav_menu'])): ?>
                        <!-- Navigation Menu -->
                        <nav class="footer-navigation">
                            <?php
                            wp_nav_menu([
                                'menu' => $column['nav_menu'],
                                'container' => false,
                                'menu_class' => 'footer-menu',
                                'fallback_cb' => false,
                            ]);
                            ?>
                        </nav>
                        <?php elseif ($column['column_type'] === 'text' && !empty($column['text_content'])): ?>
                        <!-- Text Content -->
                        <div class="footer-text-content">
                            <?php echo wp_kses_post($column['text_content']); ?>
                        </div>
                        <?php elseif ($column['column_type'] === 'image' && !empty($column['image']['url'])): ?>
                        <!-- Image -->
                        <div class="footer-image-content">
                            <?php if (!empty($column['image_link']['url'])): ?>
                            <a href="<?php echo esc_url($column['image_link']['url']); ?>"
                                <?php echo $column['image_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                <?php echo $column['image_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                <?php endif; ?>
                                <img src="<?php echo esc_url($column['image']['url']); ?>"
                                    alt="<?php echo esc_attr($column['column_title'] ?: 'Footer Image'); ?>"
                                    class="footer-image">
                                <?php if (!empty($column['image_link']['url'])): ?>
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Social Media Icons -->
                        <?php if ($column['show_social_icons'] === 'yes' && !empty($column['social_media_icons'])): ?>
                        <div class="footer-social-icons">
                            <?php foreach ($column['social_media_icons'] as $social_icon): ?>
                            <?php if (!empty($social_icon['social_link']['url']) && !empty($social_icon['social_icon']['value'])): ?>
                            <a href="<?php echo esc_url($social_icon['social_link']['url']); ?>" class="social-icon"
                                <?php echo $social_icon['social_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                <?php echo $social_icon['social_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>
                                aria-label="<?php echo esc_attr($social_icon['social_icon']['value']); ?>">
                                <?php \Elementor\Icons_Manager::render_icon($social_icon['social_icon'], ['aria-hidden' => 'true']); ?>
                            </a>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Copyright Section -->
    <?php if ($settings['show_copyright'] === 'yes' && !empty($settings['copyright_content'])): ?>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="copyright-content">
                        <?php echo wp_kses_post($settings['copyright_content']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php
    }
}
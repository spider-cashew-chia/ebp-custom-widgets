<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Services_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_services_1';
    }

    public function get_title()
    {
        return __('EBP Custom Services 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-kit-details';
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
        return ['ebp-custom-services-1-style'];
    }


    protected function register_controls()
    {
        // Content Section - for all the content controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Rich text control for section title
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>We provide effective<span class="aximo-title-animation">design solutions<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span></h2>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your section title here...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Services Repeater Section
        $this->start_controls_section(
            'services_section',
            [
                'label' => __('Services', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for services
        $repeater = new \Elementor\Repeater();

        // Icon class control
        $repeater->add_control(
            'service_icon',
            [
                'label' => __('Icon Class', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('icon-design-tools', 'ebp-custom-widgets'),
                'placeholder' => __('e.g., icon-design-tools', 'ebp-custom-widgets'),
                'description' => __('Enter the icon class name (e.g., icon-design-tools, icon-branding)', 'ebp-custom-widgets'),
            ]
        );

        // Service title control
        $repeater->add_control(
            'service_title',
            [
                'label' => __('Service Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('UI/UX Design', 'ebp-custom-widgets'),
                'placeholder' => __('Enter service title...', 'ebp-custom-widgets'),
            ]
        );

        // Service description control
        $repeater->add_control(
            'service_description',
            [
                'label' => __('Service Description', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Focusing on user interface (UI) and user experience (UX) design enhance the usability and accessibility of digital products & app.', 'ebp-custom-widgets'),
                'placeholder' => __('Enter service description...', 'ebp-custom-widgets'),
                'rows' => 3,
            ]
        );

        // Service link control
        $repeater->add_control(
            'service_link',
            [
                'label' => __('Service Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        // Animation delay control
        $repeater->add_control(
            'animation_delay',
            [
                'label' => __('Animation Delay', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('0.1s', 'ebp-custom-widgets'),
                'placeholder' => __('e.g., 0.1s', 'ebp-custom-widgets'),
                'description' => __('Enter animation delay value (e.g., 0.1s, 0.2s)', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'services_list',
            [
                'label' => __('Services List', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_icon' => __('icon-design-tools', 'ebp-custom-widgets'),
                        'service_title' => __('UI/UX Design', 'ebp-custom-widgets'),
                        'service_description' => __('Focusing on user interface (UI) and user experience (UX) design enhance the usability and accessibility of digital products & app.', 'ebp-custom-widgets'),
                        'service_link' => ['url' => '#'],
                        'animation_delay' => __('0.1s', 'ebp-custom-widgets'),
                    ],
                    [
                        'service_icon' => __('icon-branding', 'ebp-custom-widgets'),
                        'service_title' => __('Graphic Design', 'ebp-custom-widgets'),
                        'service_description' => __('Creating visual elements such as logos, branding materials, page layout techniques, brochures, & other marketing collateral.', 'ebp-custom-widgets'),
                        'service_link' => ['url' => '#'],
                        'animation_delay' => __('0.2s', 'ebp-custom-widgets'),
                    ],
                    [
                        'service_icon' => __('icon-web', 'ebp-custom-widgets'),
                        'service_title' => __('Web Design', 'ebp-custom-widgets'),
                        'service_description' => __('Designing and developing websites to ensure they are visually look and appealing, user-friendly, and functional your website.', 'ebp-custom-widgets'),
                        'service_link' => ['url' => '#'],
                        'animation_delay' => __('0.3s', 'ebp-custom-widgets'),
                    ],
                    [
                        'service_icon' => __('icon-design-thinking', 'ebp-custom-widgets'),
                        'service_title' => __('Motion Graphics', 'ebp-custom-widgets'),
                        'service_description' => __('Creating animate graphics, videos for various purposes, including marketing and entertainment. To help sell a product or service.', 'ebp-custom-widgets'),
                        'service_link' => ['url' => '#'],
                        'animation_delay' => __('0.4s', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        ?>

<div class="section aximo-section-padding4">
    <div class="container">
        <?php if (!empty($settings['section_title'])): ?>
        <div class="aximo-section-title center">
            <?php echo wp_kses_post($settings['section_title']); ?>
        </div>
        <?php endif; ?>
        <div class="aximo-service-wrap">
            <div class="row">
                <?php
                        // Check if services list exists and has items
                        if (!empty($settings['services_list'])) {
                            foreach ($settings['services_list'] as $index => $service) {
                                // Get service link settings
                                $service_link = $service['service_link'];
                                $service_url = !empty($service_link['url']) ? esc_url($service_link['url']) : '#';
                                $service_target = !empty($service_link['is_external']) ? ' target="_blank"' : '';
                                $service_nofollow = !empty($service_link['nofollow']) ? ' rel="nofollow"' : '';

                                // Get animation delay, default to empty if not set
                                $animation_delay = !empty($service['animation_delay']) ? esc_attr($service['animation_delay']) : '';
                                $delay_attr = !empty($animation_delay) ? ' data-wow-delay="' . $animation_delay . '"' : '';
                                ?>
                <div class="col-lg-6">
                    <div class="aximo-iconbox-wrap wow fadeInUpX" <?php echo $delay_attr; ?>>
                        <?php if (!empty($service['service_icon'])): ?>
                        <div class="aximo-iconbox-icon">
                            <i class="<?php echo esc_attr($service['service_icon']); ?>"></i>
                        </div>
                        <?php endif; ?>
                        <div class="aximo-iconbox-data">
                            <?php if (!empty($service['service_title'])): ?>
                            <h3><?php echo esc_html($service['service_title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($service['service_description'])): ?>
                            <p><?php echo esc_html($service['service_description']); ?></p>
                            <?php endif; ?>
                            <a class="aximo-icon" href="<?php echo $service_url; ?>"
                                <?php echo $service_target . $service_nofollow; ?>>
                                <img src="assets/images/icon/arrow-right.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                            }
                        }
                        ?>
            </div>
        </div>
    </div>
</div>
<!-- End section -->

<?php
    }
}
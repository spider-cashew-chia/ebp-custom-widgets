<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Hero_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_hero_1';
    }

    public function get_title()
    {
        return __('EBP Custom Hero 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-hero';
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
        return ['ebp-custom-hero-1-style'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Hero Image
        $this->add_control(
            'hero_image',
            [
                'label' => __('Hero Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Hero Heading Field
        $this->add_control(
            'hero_heading',
            [
                'label' => __('Hero Heading', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Your Hero Heading', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your hero heading', 'ebp-custom-widgets'),
            ]
        );

        // First Rich Text Field
        $this->add_control(
            'hero_rich_text_1',
            [
                'label' => __('First Rich Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>Your Hero Heading</h2><p>This is your first rich text content that can include HTML formatting.</p>', 'ebp-custom-widgets'),
            ]
        );

        // Link Field
        $this->add_control(
            'hero_link',
            [
                'label' => __('Hero Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
            ]
        );

        // Second Rich Text Field
        $this->add_control(
            'hero_rich_text_2',
            [
                'label' => __('Second Rich Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>This is your second rich text content with additional information.</p>', 'ebp-custom-widgets'),
            ]
        );

        // Mobile Rich Text Field
        $this->add_control(
            'hero_mobile_rich_text',
            [
                'label' => __('Mobile Rich Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>This content will be displayed on mobile devices only.</p>', 'ebp-custom-widgets'),
                'description' => __('This rich text content will only be visible on mobile devices (screens smaller than 768px)', 'ebp-custom-widgets'),
            ]
        );

        $this->add_control(
            'hero_background_color',
            [
                'label' => __('Hero Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-hero-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hero_text_color',
            [
                'label' => __('Hero Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-hero-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="overflow-hidden inverted hero-section ebp-custom-hero-1">

            <div class="container-fluid back back-background d-none d-lg-block">
                <div class="row h-100">
                    <div class="col-lg-6 offset-lg-6" data-aos="fade-in">
                        <figure class="background" role="none">
                            <?php if (!empty($settings['hero_image']['url'])): ?>
                                <img src="<?php echo esc_url($settings['hero_image']['url']); ?>" alt="Hero Image" class="w-100">
                            <?php endif; ?>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column container py-10 min-vh-100 level-1 hero-section--text d-none d-lg-block">
                <div class="row align-items-center  justify-content-lg-start">
                    <div class="col-md-8 col-lg-5  text-lg-start">


                        <!-- Desktop Rich Text Content -->
                        <div class="text-content mb-3 d-none d-md-block">
                            <?php echo wp_kses_post($settings['hero_rich_text_1']); ?>
                        </div>



                        <div class="hero-rich-text-2">
                            <?php echo wp_kses_post($settings['hero_rich_text_2']); ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- mobile section -->
            <div class="mobile-section d-block d-lg-none">
                <div class="mobile-section--image">
                    <figure class="background-1" role="none">
                        <?php if (!empty($settings['hero_image']['url'])): ?>
                            <img src="<?php echo esc_url($settings['hero_image']['url']); ?>" alt="Hero Image" class="w-100">
                        <?php endif; ?>
                    </figure>
                    <!-- Hero Heading -->
                    <div class="container">
                        <div class="row">
                            <?php if (!empty($settings['hero_heading'])): ?>
                                <h1 class="hero-heading mb-3"><?php echo esc_html($settings['hero_heading']); ?></h1>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="mobile-section--text">
                    <!-- Mobile Rich Text Content -->
                    <div class="container">

                        <div class="mobile-text-content mb-3 ">
                            <?php echo wp_kses_post($settings['hero_mobile_rich_text']); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
}
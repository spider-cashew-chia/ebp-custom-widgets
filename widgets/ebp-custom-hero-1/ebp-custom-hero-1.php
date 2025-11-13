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
        return 'eicon-ehp-hero';
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
        // Content Section - for all the content controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Rich text control for hero content
        $this->add_control(
            'hero_content',
            [
                'label' => __('Hero Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h1><span class="aximo-title-animation">A creative<img src="assets/images/v1/star.png" alt=""></span>design studio</h1><p>We\'re a creative design studio specializing in meeting the needs of the new generation. We offer innovative and cutting-edge design solutions to help our clients stand out in today\'s fast-paced.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your hero content here...', 'ebp-custom-widgets'),
            ]
        );

        // Button text control
        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Book a free consultation', 'ebp-custom-widgets'),
                'placeholder' => __('Enter button text...', 'ebp-custom-widgets'),
            ]
        );

        // Button URL/Page chooser control
        $this->add_control(
            'button_url',
            [
                'label' => __('Button Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        // Image control for hero thumbnail
        $this->add_control(
            'hero_image',
            [
                'label' => __('Hero Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - for background color
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background color control for hero section
        $this->add_control(
            'hero_background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .aximo-hero-section' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        // Get button URL settings and build the link attributes
        $button_url = $settings['button_url'];
        $button_link = '#';
        $button_target = '';
        $button_rel = '';

        if (!empty($button_url['url'])) {
            $button_link = esc_url($button_url['url']);

            // Add target attribute if link opens in new tab
            if (!empty($button_url['is_external'])) {
                $button_target = ' target="_blank"';
            }

            // Add rel attribute for nofollow links
            if (!empty($button_url['nofollow'])) {
                $button_rel = ' rel="nofollow"';
            }
        }

        // Get hero image URL
        $hero_image_url = '';
        $hero_image_alt = '';
        if (!empty($settings['hero_image']['url'])) {
            $hero_image_url = esc_url($settings['hero_image']['url']);
            $hero_image_alt = !empty($settings['hero_image']['alt']) ? esc_attr($settings['hero_image']['alt']) : '';
        }

        // Get background color and build inline style
        $bg_color_style = '';
        if (!empty($settings['hero_background_color'])) {
            $bg_color_style = ' style="background-color: ' . esc_attr($settings['hero_background_color']) . ';"';
        }

        ?>
<!-- Hero  -->
<div class="aximo-hero-section" <?php echo $bg_color_style; ?>>
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-8">
                <div class="aximo-hero-content">
                    <?php
                            // Output the rich text content
                            if (!empty($settings['hero_content'])) {
                                echo wp_kses_post($settings['hero_content']);
                            }
                            ?>
                    <!-- <div class="aximo-hero-user-wrap">
                        <div class="aximo-hero-user-thumb">
                            <div class="aximo-hero-user-thumb-item wow fadeInUpX" data-wow-delay="0s">
                                <img src="assets/images/v1/user1.png" alt="">
                            </div>
                            <div class="aximo-hero-user-thumb-item wow fadeInUpX" data-wow-delay="0.25s">
                                <img src="assets/images/v1/user3.png" alt="">
                            </div>
                            <div class="aximo-hero-user-thumb-item wow fadeInUpX" data-wow-delay="0.4s">
                                <img src="assets/images/v1/user2.png" alt="">
                            </div>
                        </div>
                        <div class="aximo-hero-user-data">
                            <p>Believed by more than a thousand people</p>
                        </div>
                    </div> -->
                    <?php if (!empty($settings['button_text'])): ?>
                    <a class="aximo-call-btn" href="<?php echo $button_link; ?>"
                        <?php echo $button_target . $button_rel; ?>>
                        <?php echo esc_html($settings['button_text']); ?> <i class="icon-call"></i>
                    </a>
                    <?php endif; ?>
                    <!-- <div class="aximo-hero-shape">
                        <img src="assets/images/v1/shape1.png" alt="">
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="aximo-hero-thumb wow fadeInRight" data-wow-delay="0s">
                    <?php if (!empty($hero_image_url)): ?>
                    <img src="<?php echo $hero_image_url; ?>" alt="<?php echo $hero_image_alt; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End section -->

<?php
    }
}
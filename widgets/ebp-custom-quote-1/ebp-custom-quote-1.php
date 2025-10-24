<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Quote_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_quote_1';
    }

    public function get_title()
    {
        return __('EBP Custom Quote 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-quote-left';
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
        return ['ebp-custom-quote-1-style'];
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

        // Text Block Content Field
        $this->add_control(
            'text_block_content',
            [
                'label' => __('Text Block Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>Enter your text block content here. You can use HTML formatting.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter text content...', 'ebp-custom-widgets'),
            ]
        );

        // Font Color Control
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-quote-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Font Family Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Typography', 'ebp-custom-widgets'),
                'selector' => '{{WRAPPER}} .ebp-custom-quote-1',
            ]
        );

        // Image Repeater Control
        $this->add_control(
            'image_repeater',
            [
                'label' => __('Images', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => __('Image', 'ebp-custom-widgets'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'image_alt',
                        'label' => __('Alt Text', 'ebp-custom-widgets'),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'placeholder' => __('Enter alt text for accessibility', 'ebp-custom-widgets'),
                    ],
                ],
                'default' => [],
                'title_field' => '{{{ image_alt }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
<!-- about-style-two -->
<section class="ebp-custom-quote-1 about-style-two">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php echo wp_kses_post($settings['text_block_content']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- image repeater -->
                <?php if (!empty($settings['image_repeater'])): ?>
                <div class="image-repeater-container">
                    <?php foreach ($settings['image_repeater'] as $index => $item): ?>
                    <?php if (!empty($item['image']['url'])): ?>
                    <div class="repeater-image-item">
                        <img src="<?php echo esc_url($item['image']['url']); ?>"
                            alt="<?php echo esc_attr($item['image_alt']); ?>" class="repeater-image" />
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- about-style-two end -->
<?php
    }
}
<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Text_Block_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_text_block_1';
    }

    public function get_title()
    {
        return __('EBP Custom Text Block 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-hero-3';
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
        return ['ebp-custom-text-block-3-style'];
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

        // Simple rich text field - no need for complexity
        $this->add_control(
            'text_content',
            [
                'label' => __('Text Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>Enter your text content here. You can use HTML formatting, headings, lists, and more.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your text content...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Style section for colors
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background color control
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-text-block-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Font color control
        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-text-block-1 .text-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
<!-- Simple text block -->
<div class="ebp-custom-text-block-1">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if (!empty($settings['text_content'])): ?>
                <div class="text-content">
                    <?php echo wp_kses_post($settings['text_content']); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Simple text block end -->
<?php
    }
}
<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Text_Block_3 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_text_block_3';
    }

    public function get_title()
    {
        return __('EBP Custom Text Block 3', 'ebp-custom-widgets');
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



        // First Rich Text Field
        $this->add_control(
            'hero_rich_text_3',
            [
                'label' => __('First Rich Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>Your Hero Heading</h2><p>This is your first rich text content that can include HTML formatting.</p>', 'ebp-custom-widgets'),
            ]
        );



        // Repeater for Text Blocks
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text_block_content',
            [
                'label' => __('Text Block Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>Enter your text block content here. You can use HTML formatting.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter text content...', 'ebp-custom-widgets'),
            ]
        );

        $this->add_control(
            'text_blocks',
            [
                'label' => __('Text Blocks', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text_block_content' => __('<p>First text block content goes here.</p>', 'ebp-custom-widgets'),
                    ],
                    [
                        'text_block_content' => __('<p>Second text block content goes here.</p>', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ text_block_content.replace(/<[^>]*>/g, "").substring(0, 50) }}}...',
            ]
        );



        // $this->add_control(
        //     'hero_background_color',
        //     [
        //         'label' => __('Hero Background Color', 'ebp-custom-widgets'),
        //         'type' => Controls_Manager::COLOR,
        //         'default' => '#ffffff',
        //         'selectors' => [
        //             '{{WRAPPER}} .ebp-custom-text-block-1' => 'background-color: {{VALUE}};',
        //         ],
        //     ]
        // );

        $this->add_control(
            'hero_text_color',
            [
                'label' => __('Hero Text Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-text-block-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();




    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- about-style-two -->
        <div class="ebp-custom-text-block-3 about-style-two">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Section Heading -->
                        <?php if (!empty($settings['section_heading'])): ?>
                            <h2 class="section-heading"><?php echo esc_html($settings['section_heading']); ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <?php if (!empty($settings['text_blocks'])): ?>
                        <?php foreach ($settings['text_blocks'] as $index => $item): ?>
                            <div class="col-md-4">
                                <!-- Text Block Content -->
                                <div class="text-block-item">
                                    <?php echo wp_kses_post($item['text_block_content']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- about-style-two end -->
        <?php
    }
}
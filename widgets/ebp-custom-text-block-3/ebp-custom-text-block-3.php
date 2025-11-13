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
        return ['jquery', 'ebp-custom-text-block-3-script'];
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
            'section_heading',
            [
                'label' => __('Section Heading', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>Your Section Heading</h2><p>This is your section heading content that can include HTML formatting.</p>', 'ebp-custom-widgets'),
            ]
        );



        // Repeater for Text Blocks
        $repeater = new \Elementor\Repeater();

        // Main Text Content (always visible)
        $repeater->add_control(
            'main_text_content',
            [
                'label' => __('Main Text Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>This is your main content that will always be visible.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your main content here...', 'ebp-custom-widgets'),
            ]
        );

        // Expanded Text Content (hidden by default)
        $repeater->add_control(
            'expanded_text_content',
            [
                'label' => __('Expanded Text Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>This is additional content that will be hidden by default and shown when the read more button is clicked.</p>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your expanded content here...', 'ebp-custom-widgets'),
            ]
        );

        // Read More Button Text
        $repeater->add_control(
            'read_more_text',
            [
                'label' => __('Read More Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read More', 'ebp-custom-widgets'),
                'placeholder' => __('Read More', 'ebp-custom-widgets'),
            ]
        );

        // Read Less Button Text
        $repeater->add_control(
            'read_less_text',
            [
                'label' => __('Read Less Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read Less', 'ebp-custom-widgets'),
                'placeholder' => __('Read Less', 'ebp-custom-widgets'),
            ]
        );

        // Page Selection for View Button
        $repeater->add_control(
            'page_link',
            [
                'label' => __('Page Link', 'ebp-custom-widgets'),
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

        // Page View Button Text
        $repeater->add_control(
            'page_view_button_text',
            [
                'label' => __('Page View Button Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('View Page', 'ebp-custom-widgets'),
                'placeholder' => __('View Page', 'ebp-custom-widgets'),
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
                        'main_text_content' => __('<p>First text block main content goes here.</p>', 'ebp-custom-widgets'),
                        'expanded_text_content' => __('<p>This is additional content for the first text block.</p>', 'ebp-custom-widgets'),
                        'read_more_text' => __('Read More', 'ebp-custom-widgets'),
                        'read_less_text' => __('Read Less', 'ebp-custom-widgets'),
                    ],
                    [
                        'main_text_content' => __('<p>Second text block main content goes here.</p>', 'ebp-custom-widgets'),
                        'expanded_text_content' => __('<p>This is additional content for the second text block.</p>', 'ebp-custom-widgets'),
                        'read_more_text' => __('Read More', 'ebp-custom-widgets'),
                        'read_less_text' => __('Read Less', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ main_text_content.replace(/<[^>]*>/g, "").substring(0, 50) }}}...',
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

        // Background Color Control
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-text-block-3' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Font Color Control
        $this->add_control(
            'font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-text-block-3' => 'color: {{VALUE}};',
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
                            <div class="section-heading"><?php echo wp_kses_post($settings['section_heading']); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="row">
                    <?php if (!empty($settings['text_blocks'])): ?>
                        <?php foreach ($settings['text_blocks'] as $index => $item): ?>
                            <div class="col-md-4">
                                <!-- Text Block Content -->
                                <div class="text-block-item">
                                    <div class="text-content">
                                        <!-- Main content (always visible) -->
                                        <div class="main-content">
                                            <?php echo wp_kses_post($item['main_text_content']); ?>
                                        </div>

                                        <!-- Expanded content (hidden by default) -->
                                        <?php if (!empty($item['expanded_text_content'])): ?>
                                            <div class="expanded-content" style="display: none;">
                                                <?php echo wp_kses_post($item['expanded_text_content']); ?>
                                            </div>

                                            <!-- Read More/Less Button -->
                                            <div class="read-more-container">
                                                <button class="read-more-btn" data-item-id="<?php echo esc_attr($item['_id']); ?>"
                                                    data-read-more="<?php echo esc_attr($item['read_more_text']); ?>"
                                                    data-read-less="<?php echo esc_attr($item['read_less_text']); ?>" aria-expanded="false">
                                                    <?php echo esc_html($item['read_more_text']); ?>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <!-- page view button -->
                                        <?php if (!empty($item['page_link']['url'])): ?>
                                            <div class="page-view-button">
                                                <?php
                                                // Get the link attributes
                                                $target = $item['page_link']['is_external'] ? ' target="_blank"' : '';
                                                $nofollow = $item['page_link']['nofollow'] ? ' rel="nofollow"' : '';
                                                $button_text = !empty($item['page_view_button_text']) ? esc_html($item['page_view_button_text']) : __('View Page', 'ebp-custom-widgets');
                                                ?>
                                                <a href="<?php echo esc_url($item['page_link']['url']); ?>" class="page-view-link button"
                                                    <?php echo $target; ?>                     <?php echo $nofollow; ?>>
                                                    <?php echo $button_text; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Values_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_values_1';
    }

    public function get_title()
    {
        return __('EBP Custom Values 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-values';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery', 'ebp-custom-values-1-script'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-values-1-style'];
    }


    protected function register_controls()
    {
        // Values Repeater Section
        $this->start_controls_section(
            'values_section',
            [
                'label' => __('Values', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater field for values
        $repeater = new \Elementor\Repeater();

        // Rich text field inside repeater
        $repeater->add_control(
            'value_content',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h3>Value Title</h3><p>Your content here...</p>', 'ebp-custom-widgets'),
            ]
        );

        // Background color control for each item
        $repeater->add_control(
            'item_background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        // Font color control for each item
        $repeater->add_control(
            'item_font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'values_list',
            [
                'label' => __('Values List', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'value_content' => __('<h3>1. Relationship-Driven</h3><p>We prioritise long-term partnerships over short-term wins.</p>', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ value_content }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Check if values list exists and has items
        if (empty($settings['values_list'])) {
            return;
        }
        ?>
        <!-- ebp-custom-values-1 -->
        <div class="ebp-custom-values-1">
            <div class="container-fluid">
                <div class="grid">
                    <?php foreach ($settings['values_list'] as $item): ?>
                        <div class="grid-cols">
                            <div class="ebp-custom-values-1--item" style="<?php
                            // Build inline styles for background and font color
                            $inline_styles = '';
                            if (!empty($item['item_background_color'])) {
                                $inline_styles .= 'background-color: ' . esc_attr($item['item_background_color']) . '; ';
                            }
                            if (!empty($item['item_font_color'])) {
                                $inline_styles .= 'color: ' . esc_attr($item['item_font_color']) . '; ';
                            }
                            echo $inline_styles;
                            ?>">
                                <?php echo wp_kses_post($item['value_content']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- ebp-custom-values-1 end -->
        <?php
    }
}
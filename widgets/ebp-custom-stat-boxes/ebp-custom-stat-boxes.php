<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Stat_Boxes extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_stat_boxes';
    }

    public function get_title()
    {
        return __('EBP Custom Stat Boxes', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-stat-boxes';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery', 'gsap-js', 'gsap-scrolltrigger-js', 'ebp-custom-stat-boxes-script'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-stat-boxes-style'];
    }


    protected function register_controls()
    {
        // Stat Boxes Repeater Section
        $this->start_controls_section(
            'stat_boxes_section',
            [
                'label' => __('Stat Boxes', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater field for stat boxes
        $repeater = new \Elementor\Repeater();

        // Number field inside repeater
        $repeater->add_control(
            'stat_number',
            [
                'label' => __('Number', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'description' => __('Enter the number to display (leave empty if no number)', 'ebp-custom-widgets'),
            ]
        );

        // Symbol selector (+ or %)
        $repeater->add_control(
            'stat_symbol',
            [
                'label' => __('Symbol', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'ebp-custom-widgets'),
                    '+' => __('Plus (+)', 'ebp-custom-widgets'),
                    '%' => __('Percent (%)', 'ebp-custom-widgets'),
                ],
                'description' => __('Choose a symbol to display after the number', 'ebp-custom-widgets'),
            ]
        );

        // Rich text field inside repeater
        $repeater->add_control(
            'stat_box_content',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Your content here...', 'ebp-custom-widgets'),
                'description' => __('Text content to display below the number', 'ebp-custom-widgets'),
            ]
        );

        // Background color control for each stat box
        $repeater->add_control(
            'stat_box_background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        // Font color control for each stat box
        $repeater->add_control(
            'stat_box_font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'stat_boxes_list',
            [
                'label' => __('Stat Boxes List', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stat_number' => 400,
                        'stat_symbol' => '+',
                        'stat_box_content' => __('candidates', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ stat_number }}}{{{ stat_symbol }}} {{{ stat_box_content }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section for main container background
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background control for the main container
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background',
                'label' => __('Background', 'ebp-custom-widgets'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .ebp-custom-stat-boxes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Check if stat boxes list exists and has items
        if (empty($settings['stat_boxes_list'])) {
            return;
        }
        ?>
        <!-- ebp-custom-stat-boxes -->
        <div class="ebp-custom-stat-boxes">
            <div class="container">
                <div class="row">
                    <?php foreach ($settings['stat_boxes_list'] as $index => $item): ?>
                        <div class="col-md-3">
                            <div class="ebp-custom-stat-boxes--item" style="<?php
                            // Build inline styles for background and font color
                            $inline_styles = '';
                            if (!empty($item['stat_box_background_color'])) {
                                $inline_styles .= 'background-color: ' . esc_attr($item['stat_box_background_color']) . '; ';
                            }
                            if (!empty($item['stat_box_font_color'])) {
                                $inline_styles .= 'color: ' . esc_attr($item['stat_box_font_color']) . '; ';
                            }
                            echo $inline_styles;
                            ?>">
                                <?php if (!empty($item['stat_number'])): ?>
                                    <div class="ebp-custom-stat-boxes--number-wrapper">
                                        <span class="ebp-custom-stat-boxes--number"
                                            data-target="<?php echo esc_attr($item['stat_number']); ?>"
                                            data-index="<?php echo esc_attr($index); ?>">
                                            0
                                        </span>
                                        <?php if (!empty($item['stat_symbol'])): ?>
                                            <span class="ebp-custom-stat-boxes--symbol"><?php echo esc_html($item['stat_symbol']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['stat_box_content'])): ?>
                                    <div class="ebp-custom-stat-boxes--content">
                                        <?php echo wp_kses_post($item['stat_box_content']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- ebp-custom-stat-boxes end -->
        <?php
    }
}
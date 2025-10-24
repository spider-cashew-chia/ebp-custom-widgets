<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Accordion_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_accordion_1';
    }

    public function get_title()
    {
        return __('EBP Custom Accordion 1', 'ebp-custom-widgets');
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
        return ['ebp-custom-accordion-1-style'];
    }


    protected function register_controls()
    {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Section Title
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Frequently Asked Questions', 'ebp-custom-widgets'),
                'placeholder' => __('Enter section title', 'ebp-custom-widgets'),
            ]
        );

        // Accordion ID Control
        $this->add_control(
            'accordion_id',
            [
                'label' => __('Accordion ID', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => 'ebp-accordion-' . uniqid(),
                'placeholder' => __('Enter unique accordion ID', 'ebp-custom-widgets'),
                'description' => __('Unique identifier for this accordion (auto-generated if empty)', 'ebp-custom-widgets'),
            ]
        );

        // Background Color Control
        $this->add_control(
            'section_background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f8f9fa',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-accordion-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Font Color Control
        $this->add_control(
            'section_font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .ebp-custom-accordion-1' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Accordion Button Background Color Control
        $this->add_control(
            'accordion_button_bg_color',
            [
                'label' => __('Accordion Button Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .accordion-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Accordion Button Font Color Control
        $this->add_control(
            'accordion_button_font_color',
            [
                'label' => __('Accordion Button Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .accordion-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Accordion Body Background Color Control
        $this->add_control(
            'accordion_body_bg_color',
            [
                'label' => __('Accordion Body Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .accordion-body' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Accordion Body Font Color Control
        $this->add_control(
            'accordion_body_font_color',
            [
                'label' => __('Accordion Body Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .accordion-body' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Accordion Items Repeater
        $repeater = new \Elementor\Repeater();

        // Accordion heading field in repeater
        $repeater->add_control(
            'accordion_heading',
            [
                'label' => __('Accordion Heading', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('What is this about?', 'ebp-custom-widgets'),
                'placeholder' => __('Enter accordion heading', 'ebp-custom-widgets'),
            ]
        );

        // Accordion content field in repeater
        $repeater->add_control(
            'accordion_content',
            [
                'label' => __('Accordion Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Enter your accordion content here. This can include text, links, and basic HTML formatting.', 'ebp-custom-widgets'),
                'placeholder' => __('Enter accordion content', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater control
        $this->add_control(
            'accordion_items',
            [
                'label' => __('Accordion Items', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_heading' => __('What is this service?', 'ebp-custom-widgets'),
                        'accordion_content' => __('This is a detailed explanation of our service and how it can benefit you.', 'ebp-custom-widgets'),
                    ],
                    [
                        'accordion_heading' => __('How much does it cost?', 'ebp-custom-widgets'),
                        'accordion_content' => __('Our pricing is competitive and transparent. Contact us for a personalized quote.', 'ebp-custom-widgets'),
                    ],
                    [
                        'accordion_heading' => __('How do I get started?', 'ebp-custom-widgets'),
                        'accordion_content' => __('Getting started is easy! Simply contact us through our form or give us a call.', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ accordion_heading }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $accordion_id = !empty($settings['accordion_id']) ? $settings['accordion_id'] : 'ebp-accordion-' . uniqid();
        ?>
<div class="ebp-custom-accordion-1">
    <div class="container">
        <!-- Section Title -->
        <?php if (!empty($settings['section_title'])): ?>
        <div class="row mb-0">
            <div class="col-12">
                <h2 class="section-title mb-4"><?php echo esc_html($settings['section_title']); ?></h2>
            </div>
        </div>
        <?php endif; ?>

        <!-- Bootstrap 5 Accordion -->
        <?php if (!empty($settings['accordion_items'])): ?>
        <div class="row ">
            <div class="col-12">
                <div class="accordion" id="<?php echo esc_attr($accordion_id); ?>">
                    <?php foreach ($settings['accordion_items'] as $index => $item):
                                    $item_id = $accordion_id . '-item-' . $index;
                                    $heading_id = $accordion_id . '-heading-' . $index;
                                    $collapse_id = $accordion_id . '-collapse-' . $index;
                                    ?>
                    <div class="accordion-item">
                        <!-- Accordion Header -->
                        <div class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                            <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#<?php echo esc_attr($collapse_id); ?>"
                                aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                <?php if (!empty($item['accordion_heading'])): ?>
                                <h3>
                                    <?php echo esc_html($item['accordion_heading']); ?>
                                </h3>
                                <?php endif; ?>
                            </button>
                        </div>

                        <!-- Accordion Content -->
                        <div id="<?php echo esc_attr($collapse_id); ?>"
                            class=" accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>"
                            aria-labelledby="<?php echo esc_attr($heading_id); ?>"
                            data-bs-parent=" #<?php echo esc_attr($accordion_id); ?>">
                            <div class="accordion-body">
                                <?php if (!empty($item['accordion_content'])): ?>
                                <?php echo wp_kses_post($item['accordion_content']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
    }
}
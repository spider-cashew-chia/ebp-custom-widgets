<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Contact_2 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_contact_2';
    }

    public function get_title()
    {
        return __('EBP Custom Contact 2', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-features';
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
        return ['ebp-custom-contact-2-style'];
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

        // Heading Control
        $this->add_control(
            'contact_heading',
            [
                'label' => __('Heading', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Contact Us', 'ebp-custom-widgets'),
                'placeholder' => __('Enter heading text', 'ebp-custom-widgets'),
                'description' => __('Enter the main heading for the contact section', 'ebp-custom-widgets'),
            ]
        );

        // Contact Form 7 Dropdown
        $this->add_control(
            'contact_form_7',
            [
                'label' => __('Contact Form 7', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_contact_form_7_forms(),
                'default' => '',
                'description' => __('Select a Contact Form 7 form to display', 'ebp-custom-widgets'),
            ]
        );

        // Font Color Control
        $this->add_control(
            'font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'description' => __('Choose the text color for the heading and form', 'ebp-custom-widgets'),
                'selectors' => [
                    '{{WRAPPER}} .contact-heading' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .contact-form-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ebp-custom-contact-2">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- Heading -->
                        <?php if (!empty($settings['contact_heading'])): ?>
                            <h2 class="contact-heading"><?php echo esc_html($settings['contact_heading']); ?></h2>
                        <?php endif; ?>

                        <!-- Contact Form 7 -->
                        <?php if (!empty($settings['contact_form_7'])): ?>
                            <div class="contact-form-wrapper">
                                <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($settings['contact_form_7']) . '"]'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Get Contact Form 7 forms for dropdown
     */
    private function get_contact_form_7_forms()
    {
        $forms = [];

        // Check if Contact Form 7 is active
        if (class_exists('WPCF7_ContactForm')) {
            $cf7_forms = get_posts([
                'post_type' => 'wpcf7_contact_form',
                'post_status' => 'publish',
                'numberposts' => -1,
            ]);

            foreach ($cf7_forms as $form) {
                $forms[$form->ID] = $form->post_title;
            }
        }

        // If no forms found, add a placeholder
        if (empty($forms)) {
            $forms[''] = __('No Contact Form 7 forms found', 'ebp-custom-widgets');
        }

        return $forms;
    }
}
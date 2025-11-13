<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Scrolling_Text_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_scrolling_text_1';
    }

    public function get_title()
    {
        return __('EBP Custom Scrolling Text 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-divider-shape';
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
        return ['ebp-custom-scrolling-text-1-style'];
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

        // Text control for scrolling text (same text used for all slides)
        $this->add_control(
            'scrolling_text',
            [
                'label' => __('Scrolling Text', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Let\'s create new experiences', 'ebp-custom-widgets'),
                'placeholder' => __('Enter scrolling text...', 'ebp-custom-widgets'),
                'description' => __('This text will be displayed in all scrolling slides', 'ebp-custom-widgets'),
            ]
        );

        // Image control for the icon/star image (same image used for all slides)
        $this->add_control(
            'scrolling_icon',
            [
                'label' => __('Icon Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'description' => __('This image will be displayed next to the text in all scrolling slides', 'ebp-custom-widgets'),
            ]
        );

        // Number control for how many slides to display
        $this->add_control(
            'number_of_slides',
            [
                'label' => __('Number of Slides', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => 8,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'description' => __('How many duplicate slides to create for the scrolling effect', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        // Get the scrolling text
        $scrolling_text = !empty($settings['scrolling_text']) ? esc_html($settings['scrolling_text']) : 'Let\'s create new experiences';

        // Get the icon image URL and alt text
        $icon_url = '';
        $icon_alt = '';
        if (!empty($settings['scrolling_icon']['url'])) {
            $icon_url = esc_url($settings['scrolling_icon']['url']);
            $icon_alt = !empty($settings['scrolling_icon']['alt']) ? esc_attr($settings['scrolling_icon']['alt']) : '';
        }

        // Get the number of slides to display (default to 8 if not set)
        $number_of_slides = !empty($settings['number_of_slides']) ? intval($settings['number_of_slides']) : 8;

        ?>
<!-- Scrolling Text  -->
<div class="aximo-auto-slider-section">
    <div class="swiper aximo-auto-slider">
        <div class="swiper-wrapper">
            <?php
                    // Loop to create the specified number of slides
                    // Each slide uses the same text and icon from the controls
                    for ($i = 0; $i < $number_of_slides; $i++) {
                        ?>
            <div class="swiper-slide">
                <div class="aximo-auto-slider-item">
                    <?php if (!empty($scrolling_text)): ?>
                    <h3><?php echo $scrolling_text; ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($icon_url)): ?>
                    <img src="<?php echo $icon_url; ?>" alt="<?php echo $icon_alt; ?>">
                    <?php endif; ?>
                </div>
            </div>
            <?php
                    }
                    ?>
        </div>
    </div>
</div>
<!-- End section -->

<?php
    }
}
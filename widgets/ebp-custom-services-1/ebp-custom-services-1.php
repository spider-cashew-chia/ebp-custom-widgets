<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Services_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_services_1';
    }

    public function get_title()
    {
        return __('EBP Custom Services 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-services';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery', 'ebp-custom-services-1-script'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-services-1-style'];
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

        // Repeater for Hero Sections
        $repeater = new \Elementor\Repeater();

        // Image
        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Main Text Content (always visible)
        $repeater->add_control(
            'main_text_content',
            [
                'label' => __('Main Text Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>Your Hero Heading</h2><p>This is your main content that will always be visible.</p>', 'ebp-custom-widgets'),
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

        // Background Color
        $repeater->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        // Font Color
        $repeater->add_control(
            'font_color',
            [
                'label' => __('Font Color', 'ebp-custom-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        // Gallery Images for this service item
        $repeater->add_control(
            'gallery_images',
            [
                'label' => __('Gallery Images', 'ebp-custom-widgets'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hero_sections',
            [
                'label' => __('Hero Sections', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'main_text_content' => __('<h2>First Hero Section</h2><p>This is your first hero content.</p>', 'ebp-custom-widgets'),
                        'expanded_text_content' => __('<p>This is additional content for the first section.</p>', 'ebp-custom-widgets'),
                        'read_more_text' => __('Read More', 'ebp-custom-widgets'),
                        'read_less_text' => __('Read Less', 'ebp-custom-widgets'),
                    ],
                    [
                        'main_text_content' => __('<h2>Second Hero Section</h2><p>This is your second hero content.</p>', 'ebp-custom-widgets'),
                        'expanded_text_content' => __('<p>This is additional content for the second section.</p>', 'ebp-custom-widgets'),
                        'read_more_text' => __('Read More', 'ebp-custom-widgets'),
                        'read_less_text' => __('Read Less', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ main_text_content.replace(/<[^>]*>/g, "").substring(0, 50) }}}...',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Check if we have hero sections
        if (empty($settings['hero_sections'])) {
            return;
        }

        // Loop through each hero section in the repeater
        foreach ($settings['hero_sections'] as $index => $item):
            // Get background and font colors for this item
            $background_color = !empty($item['background_color']) ? $item['background_color'] : '#ffffff';
            $font_color = !empty($item['font_color']) ? $item['font_color'] : '#000000';
            ?>
            <div class="overflow-hidden inverted ebp-custom-services-1 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>"
                style="background-color: <?php echo esc_attr($background_color); ?>; color: <?php echo esc_attr($font_color); ?>;">


                <div class=" container-fluid back back-background">
                    <div class="row h-100">
                        <div class="col-lg-6 offset-lg-6" data-aos="fade-in">
                            <figure class="background" role="none">
                                <?php if (!empty($item['image']['url'])): ?>
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="Image" class="w-100">
                                <?php endif; ?>

                                <!-- Gallery Icon Overlay -->
                                <?php if (!empty($item['gallery_images'])): ?>
                                    <div class="gallery-icon-overlay" data-gallery-id="gallery-<?php echo esc_attr($item['_id']); ?>">
                                        <img src="/wp-content/uploads/2025/09/view-gallery-icon-1.svg" alt="View Gallery"
                                            class="gallery-icon">
                                    </div>
                                <?php endif; ?>
                            </figure>

                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column container container--wide py-10 min-vh-100 level-1 hero-section--text">
                    <div class="row align-items-center justify-content-center justify-content-lg-start my-auto">
                        <div class="col-md-8 col-lg-5 text-lg-start">
                            <div class="text-content mb-3">
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
                                            data-read-less="<?php echo esc_attr($item['read_less_text']); ?>">
                                            <?php echo esc_html($item['read_more_text']); ?>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            <?php
        endforeach;

        // Add popup galleries for each service item that has gallery images
        foreach ($settings['hero_sections'] as $index => $item):
            if (!empty($item['gallery_images'])):
                ?>
                <!-- Gallery Popup -->
                <div id="gallery-<?php echo esc_attr($item['_id']); ?>" class="gallery-popup" style="display: none;">
                    <div class="gallery-popup-overlay"></div>
                    <div class="gallery-popup-content">
                        <button class="gallery-close" aria-label="Close Gallery">&times;</button>
                        <div class="gallery-slider">
                            <?php foreach ($item['gallery_images'] as $gallery_image): ?>
                                <div class="gallery-slide">
                                    <img src="<?php echo esc_url($gallery_image['url']); ?>" alt="Gallery Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gallery-navigation">
                            <button class="gallery-prev" aria-label="Previous Image">&#8249;</button>
                            <button class="gallery-next" aria-label="Next Image">&#8250;</button>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        endforeach;
    }
}
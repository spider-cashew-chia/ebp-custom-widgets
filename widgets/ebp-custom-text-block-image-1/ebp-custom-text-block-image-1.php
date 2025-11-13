<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Text_Block_Image_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_text_block_image_1';
    }

    public function get_title()
    {
        return __('EBP Custom Text Block Image 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-image-box';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery', 'ebp-custom-text-block-image-1-script'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-text-block-image-1-style'];
    }


    protected function register_controls()
    {
        // Repeater Section
        $this->start_controls_section(
            'items_section',
            [
                'label' => __('Items', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for items
        $repeater = new \Elementor\Repeater();

        // Image control within repeater
        $repeater->add_control(
            'item_image',
            [
                'label' => __('Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        // Rich text control within repeater
        $repeater->add_control(
            'item_content',
            [
                'label' => __('Content', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<p>Your content here...</p>', 'ebp-custom-widgets'),
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'items_list',
            [
                'label' => __('Items', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_content' => __('<p>Your content here...</p>', 'ebp-custom-widgets'),
                    ],
                ],
                'title_field' => '{{{ item_content }}}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <!-- about-style-two -->
        <div class="ebp-custom-text-block-image-1 about-style-two">
            <div class="container">
                <div class="row">
                    <?php
                    // Loop through repeater items
                    if (!empty($settings['items_list'])) {
                        foreach ($settings['items_list'] as $item) {
                            ?>

                            <div class="col">
                                <?php if (!empty($item['item_image']['url'])): ?>
                                    <img src="<?php echo esc_url($item['item_image']['url']); ?>"
                                        alt="<?php echo esc_attr($item['item_image']['alt'] ?? ''); ?>" class="img-fluid">
                                <?php endif; ?>
                                <?php if (!empty($item['item_content'])): ?>
                                    <div class="ebp-custom-text-block-image-1_text">

                                        <?php echo wp_kses_post($item['item_content']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- about-style-two end -->
        <?php
    }
}
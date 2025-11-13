<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;



class Ebp_Custom_Scroll_Slider_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_scroll_slider_1';
    }

    public function get_title()
    {
        return __('EBP Custom Scroll Slider 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-slider-push';
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
        return ['ebp-custom-scroll-slider-1-style'];
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

        // Rich text control for section title
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('<h2>Have a wide range of<span class="aximo-title-animation">creative projects<span class="aximo-title-icon"><img src="assets/images/v1/star2.png" alt=""></span></span></h2>', 'ebp-custom-widgets'),
                'placeholder' => __('Enter your section title here...', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();

        // Slider Items Repeater Section
        $this->start_controls_section(
            'slider_section',
            [
                'label' => __('Slider Items', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater control for slider items
        $repeater = new \Elementor\Repeater();

        // Image control for project thumbnail
        $repeater->add_control(
            'project_image',
            [
                'label' => __('Project Image', 'ebp-custom-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        // Project title control
        $repeater->add_control(
            'project_title',
            [
                'label' => __('Project Title', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Product Design', 'ebp-custom-widgets'),
                'placeholder' => __('Enter project title...', 'ebp-custom-widgets'),
            ]
        );

        // Project description control
        $repeater->add_control(
            'project_description',
            [
                'label' => __('Project Description', 'ebp-custom-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Developing the look and feel of physical products, aesthetics, and functionality.', 'ebp-custom-widgets'),
                'placeholder' => __('Enter project description...', 'ebp-custom-widgets'),
                'rows' => 3,
            ]
        );

        // Project link control
        $repeater->add_control(
            'project_link',
            [
                'label' => __('Project Link', 'ebp-custom-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'ebp-custom-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        // Add the repeater to the widget
        $this->add_control(
            'slider_items',
            [
                'label' => __('Slider Items', 'ebp-custom-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'project_title' => __('Product Design', 'ebp-custom-widgets'),
                        'project_description' => __('Developing the look and feel of physical products, aesthetics, and functionality.', 'ebp-custom-widgets'),
                        'project_link' => ['url' => '#'],
                    ],
                    [
                        'project_title' => __('Logo and Branding', 'ebp-custom-widgets'),
                        'project_description' => __('Creating or refreshing a company\'s logo and developing a cohesive visual identity.', 'ebp-custom-widgets'),
                        'project_link' => ['url' => '#'],
                    ],
                    [
                        'project_title' => __('App UI/UX Design', 'ebp-custom-widgets'),
                        'project_description' => __('Designing the UI/UXe for mobile apps and web applications to ensure usability & engagement.', 'ebp-custom-widgets'),
                        'project_link' => ['url' => '#'],
                    ],
                    [
                        'project_title' => __('Packaging Design', 'ebp-custom-widgets'),
                        'project_description' => __('Creating packaging solutions for products that not only protect attract customers on store.', 'ebp-custom-widgets'),
                        'project_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ project_title }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        // Get all the settings for this widget
        $settings = $this->get_settings_for_display();

        ?>
<!-- Scroll Slider  -->
<div class="section dark-bg aximo-section-padding">
    <div class="container">
        <?php if (!empty($settings['section_title'])): ?>
        <div class="aximo-section-title center light">
            <?php echo wp_kses_post($settings['section_title']); ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="swiper aximo-project-slider">
        <div class="swiper-wrapper">
            <?php
                    // Check if slider items exist and loop through them
                    if (!empty($settings['slider_items'])) {
                        foreach ($settings['slider_items'] as $index => $item) {
                            // Get project link settings
                            $project_link = $item['project_link'];
                            $project_url = !empty($project_link['url']) ? esc_url($project_link['url']) : '#';
                            $project_target = !empty($project_link['is_external']) ? ' target="_blank"' : '';
                            $project_nofollow = !empty($project_link['nofollow']) ? ' rel="nofollow"' : '';

                            // Get project image URL and alt text
                            $project_image_url = '';
                            $project_image_alt = '';
                            if (!empty($item['project_image']['url'])) {
                                $project_image_url = esc_url($item['project_image']['url']);
                                $project_image_alt = !empty($item['project_image']['alt']) ? esc_attr($item['project_image']['alt']) : '';
                            }
                            ?>
            <div class="swiper-slide">
                <div class="aximo-project-thumb">
                    <?php if (!empty($project_image_url)): ?>
                    <img src="<?php echo $project_image_url; ?>" alt="<?php echo $project_image_alt; ?>">
                    <?php endif; ?>
                    <div class="aximo-project-wrap">
                        <div class="aximo-project-data">
                            <?php if (!empty($item['project_title'])): ?>
                            <a href="<?php echo $project_url; ?>" <?php echo $project_target . $project_nofollow; ?>>
                                <h3><?php echo esc_html($item['project_title']); ?></h3>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($item['project_description'])): ?>
                            <p><?php echo esc_html($item['project_description']); ?></p>
                            <?php endif; ?>
                        </div>
                        <a class="aximo-project-icon" href="<?php echo $project_url; ?>"
                            <?php echo $project_target . $project_nofollow; ?>>
                            <svg width="34" height="28" viewBox="0 0 34 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.9795 2C19.9795 2 20.5 8 25.9795 11.2C28.4887 12.6653 31.9795 14 31.9795 14M31.9795 14H2M31.9795 14C31.9795 14 28.5339 15.415 25.9795 16.8C19.9795 20.0533 19.9795 26 19.9795 26"
                                    stroke="#FDFDE1" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                        }
                    }
                    ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- End section -->

<?php
    }
}